<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreNodeMediumRequest;
use App\Http\Requests\UpdateNodeMediumRequest;
use App\Http\Resources\Admin\NodeMediumResource;
use App\Models\NodeMedium;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NodeMediaApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('node_medium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NodeMediumResource(NodeMedium::with(['nodes_related_tos'])->get());
    }

    public function store(StoreNodeMediumRequest $request)
    {
        $nodeMedium = NodeMedium::create($request->all());
        $nodeMedium->nodes_related_tos()->sync($request->input('nodes_related_tos', []));
        foreach ($request->input('image', []) as $file) {
            $nodeMedium->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
        }

        return (new NodeMediumResource($nodeMedium))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(NodeMedium $nodeMedium)
    {
        abort_if(Gate::denies('node_medium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NodeMediumResource($nodeMedium->load(['nodes_related_tos']));
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

        return (new NodeMediumResource($nodeMedium))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(NodeMedium $nodeMedium)
    {
        abort_if(Gate::denies('node_medium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nodeMedium->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
