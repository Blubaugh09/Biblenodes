<?php

namespace App\Http\Requests;

use App\Models\DiagramType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDiagramTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('diagram_type_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'specialty_field' => [
                'string',
                'nullable',
            ],
        ];
    }
}
