<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyNodeTypeRequest;
use App\Http\Requests\StoreNodeTypeRequest;
use App\Http\Requests\UpdateNodeTypeRequest;
use App\Models\NodeType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class NodeTypeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('node_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nodeTypes = NodeType::with(['media'])->get();

        return view('admin.nodeTypes.index', compact('nodeTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('node_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.nodeTypes.create');
    }

    public function store(StoreNodeTypeRequest $request)
    {
        $nodeType = NodeType::create($request->all());

        if ($request->input('url', false)) {
            $nodeType->addMedia(storage_path('tmp/uploads/' . basename($request->input('url'))))->toMediaCollection('url');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $nodeType->id]);
        }

        return redirect()->route('admin.node-types.index');
    }

    public function edit(NodeType $nodeType)
    {
        abort_if(Gate::denies('node_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.nodeTypes.edit', compact('nodeType'));
    }

    public function update(UpdateNodeTypeRequest $request, NodeType $nodeType)
    {
        $nodeType->update($request->all());

        if ($request->input('url', false)) {
            if (! $nodeType->url || $request->input('url') !== $nodeType->url->file_name) {
                if ($nodeType->url) {
                    $nodeType->url->delete();
                }
                $nodeType->addMedia(storage_path('tmp/uploads/' . basename($request->input('url'))))->toMediaCollection('url');
            }
        } elseif ($nodeType->url) {
            $nodeType->url->delete();
        }

        return redirect()->route('admin.node-types.index');
    }

    public function show(NodeType $nodeType)
    {
        abort_if(Gate::denies('node_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.nodeTypes.show', compact('nodeType'));
    }

    public function destroy(NodeType $nodeType)
    {
        abort_if(Gate::denies('node_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nodeType->delete();

        return back();
    }

    public function massDestroy(MassDestroyNodeTypeRequest $request)
    {
        $nodeTypes = NodeType::find(request('ids'));

        foreach ($nodeTypes as $nodeType) {
            $nodeType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('node_type_create') && Gate::denies('node_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new NodeType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
