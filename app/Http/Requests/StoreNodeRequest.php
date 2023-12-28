<?php

namespace App\Http\Requests;

use App\Models\Node;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNodeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('node_create');
    }

    public function rules()
    {
        return [
            'text' => [
                'string',
                'nullable',
            ],
            'gender' => [
                'string',
                'nullable',
            ],
            'weight' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'object_type' => [
                'string',
                'nullable',
            ],
            'tags.*' => [
                'integer',
            ],
            'tags' => [
                'array',
            ],
            'other_node_images' => [
                'array',
            ],
            'location' => [
                'string',
                'nullable',
            ],
        ];
    }
}
