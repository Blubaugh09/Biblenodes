<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDiagramTypeRequest;
use App\Http\Requests\StoreDiagramTypeRequest;
use App\Http\Requests\UpdateDiagramTypeRequest;
use App\Models\DiagramType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DiagramTypesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('diagram_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $diagramTypes = DiagramType::all();

        return view('admin.diagramTypes.index', compact('diagramTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('diagram_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.diagramTypes.create');
    }

    public function store(StoreDiagramTypeRequest $request)
    {
        $diagramType = DiagramType::create($request->all());

        return redirect()->route('admin.diagram-types.index');
    }

    public function edit(DiagramType $diagramType)
    {
        abort_if(Gate::denies('diagram_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.diagramTypes.edit', compact('diagramType'));
    }

    public function update(UpdateDiagramTypeRequest $request, DiagramType $diagramType)
    {
        $diagramType->update($request->all());

        return redirect()->route('admin.diagram-types.index');
    }

    public function show(DiagramType $diagramType)
    {
        abort_if(Gate::denies('diagram_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.diagramTypes.show', compact('diagramType'));
    }

    public function destroy(DiagramType $diagramType)
    {
        abort_if(Gate::denies('diagram_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $diagramType->delete();

        return back();
    }

    public function massDestroy(MassDestroyDiagramTypeRequest $request)
    {
        $diagramTypes = DiagramType::find(request('ids'));

        foreach ($diagramTypes as $diagramType) {
            $diagramType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
