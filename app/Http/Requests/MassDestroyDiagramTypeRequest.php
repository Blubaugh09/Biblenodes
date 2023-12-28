<?php

namespace App\Http\Requests;

use App\Models\DiagramType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDiagramTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('diagram_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:diagram_types,id',
        ];
    }
}
