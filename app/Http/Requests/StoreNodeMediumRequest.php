<?php

namespace App\Http\Requests;

use App\Models\NodeMedium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNodeMediumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('node_medium_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'nodes_related_tos.*' => [
                'integer',
            ],
            'nodes_related_tos' => [
                'array',
            ],
            'media_type' => [
                'string',
                'nullable',
            ],
            'link' => [
                'string',
                'nullable',
            ],
            'image' => [
                'array',
            ],
        ];
    }
}
