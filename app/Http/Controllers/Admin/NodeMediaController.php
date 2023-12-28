<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyNodeMediumRequest;
use App\Http\Requests\StoreNodeMediumRequest;
use App\Http\Requests\UpdateNodeMediumRequest;
use App\Models\Node;
use App\Models\NodeMedium;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class NodeMediaController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('node_medium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nodeMedia = NodeMedium::with(['nodes_related_tos', 'media'])->get();

        return view('admin.nodeMedia.index', compact('nodeMedia'));
    }

    public function create()
    {
        abort_if(Gate::denies('node_medium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nodes_related_tos = Node::pluck('text', 'id');

        return view('admin.nodeMedia.create', compact('nodes_related_tos'));
    }

    public function store(StoreNodeMediumRequest $request)
    {
        $nodeMedium = NodeMedium::create($request->all());
        $nodeMedium->nodes_related_tos()->sync($request->input('nodes_related_tos', []));
        foreach ($request->input('image', []) as $file) {
            $nodeMedium->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $nodeMedium->id]);
        }

        return redirect()->route('admin.node-media.index');
    }

    public function edit(NodeMedium $nodeMedium)
    {
        abort_if(Gate::denies('node_medium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nodes_related_tos = Node::pluck('text', 'id');

        $nodeMedium->load('nodes_related_tos');

        return view('admin.nodeMedia.edit', compact('nodeMedium', 'nodes_related_tos'));
    }

    public function update(UpdateNodeMediumRequest $request, NodeMedium $nodeMedium)
    {
        $nodeMedium->update($request->all());
        $nodeMedium->nodes_related_tos()->sync($request->input('nodes_related_tos', []));
        if (count($nodeMedium->image) > 0) {
            foreach ($nodeMedium->image as $media) {
                if (! in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $nodeMedium->image->pluck('file_name')->toArray();
        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $nodeMedium->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
            }
        }

        return redirect()->route('admin.node-media.index');
    }

    public function show(NodeMedium $nodeMedium)
    {
        abort_if(Gate::denies('node_medium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nodeMedium->load('nodes_related_tos');

        return view('admin.nodeMedia.show', compact('nodeMedium'));
    }

    public function destroy(NodeMedium $nodeMedium)
    {
        abort_if(Gate::denies('node_medium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nodeMedium->delete();

        return back();
    }

    public function massDestroy(MassDestroyNodeMediumRequest $request)
    {
        $nodeMedia = NodeMedium::find(request('ids'));

        foreach ($nodeMedia as $nodeMedium) {
            $nodeMedium->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('node_medium_create') && Gate::denies('node_medium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new NodeMedium();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
