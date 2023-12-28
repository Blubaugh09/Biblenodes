<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyNodeRequest;
use App\Http\Requests\StoreNodeRequest;
use App\Http\Requests\UpdateNodeRequest;
use App\Models\ContentTag;
use App\Models\Node;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class NodesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('node_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nodes = Node::with(['user', 'tags', 'media'])->get();

        $users = User::get();

        $content_tags = ContentTag::get();

        return view('admin.nodes.index', compact('content_tags', 'nodes', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('node_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = ContentTag::pluck('name', 'id');

        return view('admin.nodes.create', compact('tags', 'users'));
    }

    public function store(StoreNodeRequest $request)
    {
        $node = Node::create($request->all());
        $node->tags()->sync($request->input('tags', []));
        if ($request->input('default_node_image', false)) {
            $node->addMedia(storage_path('tmp/uploads/' . basename($request->input('default_node_image'))))->toMediaCollection('default_node_image');
        }

        foreach ($request->input('other_node_images', []) as $file) {
            $node->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('other_node_images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $node->id]);
        }

        return redirect()->route('admin.nodes.index');
    }

    public function edit(Node $node)
    {
        abort_if(Gate::denies('node_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = ContentTag::pluck('name', 'id');

        $node->load('user', 'tags');

        return view('admin.nodes.edit', compact('node', 'tags', 'users'));
    }

    public function update(UpdateNodeRequest $request, Node $node)
    {
        $node->update($request->all());
        $node->tags()->sync($request->input('tags', []));
        if ($request->input('default_node_image', false)) {
            if (! $node->default_node_image || $request->input('default_node_image') !== $node->default_node_image->file_name) {
                if ($node->default_node_image) {
                    $node->default_node_image->delete();
                }
                $node->addMedia(storage_path('tmp/uploads/' . basename($request->input('default_node_image'))))->toMediaCollection('default_node_image');
            }
        } elseif ($node->default_node_image) {
            $node->default_node_image->delete();
        }

        if (count($node->other_node_images) > 0) {
            foreach ($node->other_node_images as $media) {
                if (! in_array($media->file_name, $request->input('other_node_images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $node->other_node_images->pluck('file_name')->toArray();
        foreach ($request->input('other_node_images', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $node->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('other_node_images');
            }
        }

        return redirect()->route('admin.nodes.index');
    }

    public function show(Node $node)
    {
        abort_if(Gate::denies('node_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $node->load('user', 'tags', 'nodesVerseConnections', 'nodesRelatedToNodeMedia');

        return view('admin.nodes.show', compact('node'));
    }

    public function destroy(Node $node)
    {
        abort_if(Gate::denies('node_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $node->delete();

        return back();
    }

    public function massDestroy(MassDestroyNodeRequest $request)
    {
        $nodes = Node::find(request('ids'));

        foreach ($nodes as $node) {
            $node->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('node_create') && Gate::denies('node_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Node();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
