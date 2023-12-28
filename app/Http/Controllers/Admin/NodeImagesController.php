<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNodeImageRequest;
use App\Http\Requests\StoreNodeImageRequest;
use App\Http\Requests\UpdateNodeImageRequest;
use App\Models\NodeImage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NodeImagesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('node_image_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nodeImages = NodeImage::all();

        return view('admin.nodeImages.index', compact('nodeImages'));
    }

    public function create()
    {
        abort_if(Gate::denies('node_image_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.nodeImages.create');
    }

    public function store(StoreNodeImageRequest $request)
    {
        $nodeImage = NodeImage::create($request->all());

        return redirect()->route('admin.node-images.index');
    }

    public function edit(NodeImage $nodeImage)
    {
        abort_if(Gate::denies('node_image_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.nodeImages.edit', compact('nodeImage'));
    }

    public function update(UpdateNodeImageRequest $request, NodeImage $nodeImage)
    {
        $nodeImage->update($request->all());

        return redirect()->route('admin.node-images.index');
    }

    public function show(NodeImage $nodeImage)
    {
        abort_if(Gate::denies('node_image_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.nodeImages.show', compact('nodeImage'));
    }

    public function destroy(NodeImage $nodeImage)
    {
        abort_if(Gate::denies('node_image_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nodeImage->delete();

        return back();
    }

    public function massDestroy(MassDestroyNodeImageRequest $request)
    {
        $nodeImages = NodeImage::find(request('ids'));

        foreach ($nodeImages as $nodeImage) {
            $nodeImage->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
