<?php

namespace App\Http\Requests;

use App\Models\NodeType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNodeTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('node_type_create');
    }

    public function rules()
    {
        return [
            'shape' => [
                'string',
                'nullable',
            ],
            'color' => [
                'string',
                'nullable',
            ],
            'type' => [
                'string',
                'nullable',
            ],
            'text_color' => [
                'string',
                'nullable',
            ],
            'font_size' => [
                'string',
                'nullable',
            ],
            'visibility' => [
                'string',
                'nullable',
            ],
            'weight' => [
                'string',
                'nullable',
            ],
            'icon_url' => [
                'string',
                'nullable',
            ],
            'event' => [
                'string',
                'nullable',
            ],
            'node' => [
                'string',
                'nullable',
            ],
        ];
    }
}
