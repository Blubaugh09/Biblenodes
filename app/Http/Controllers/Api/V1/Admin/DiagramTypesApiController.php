<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiagramTypeRequest;
use App\Http\Requests\UpdateDiagramTypeRequest;
use App\Http\Resources\Admin\DiagramTypeResource;
use App\Models\DiagramType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DiagramTypesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('diagram_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DiagramTypeResource(DiagramType::all());
    }

    public function store(StoreDiagramTypeRequest $request)
    {
        $diagramType = DiagramType::create($request->all());

        return (new DiagramTypeResource($diagramType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DiagramType $diagramType)
    {
        abort_if(Gate::denies('diagram_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DiagramTypeResource($diagramType);
    }

    public function update(UpdateDiagramTypeRequest $request, DiagramType $diagramType)
    {
        $diagramType->update($request->all());

        return (new DiagramTypeResource($diagramType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DiagramType $diagramType)
    {
        abort_if(Gate::denies('diagram_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $diagramType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
