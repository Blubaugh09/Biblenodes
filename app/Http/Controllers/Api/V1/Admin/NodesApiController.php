<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreNodeRequest;
use App\Http\Requests\UpdateNodeRequest;
use App\Http\Resources\Admin\NodeResource;
use App\Models\Node;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NodesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('node_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NodeResource(Node::with(['user', 'tags'])->get());
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

        return (new NodeResource($node))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Node $node)
    {
        abort_if(Gate::denies('node_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NodeResource($node->load(['user', 'tags']));
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

        return (new NodeResource($node))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Node $node)
    {
        abort_if(Gate::denies('node_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $node->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
