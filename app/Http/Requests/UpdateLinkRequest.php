<?php

namespace App\Http\Requests;

use App\Models\Link;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLinkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('link_edit');
    }

    public function rules()
    {
        return [
            'label' => [
                'string',
                'nullable',
            ],
            'connection_type' => [
                'string',
                'nullable',
            ],
            'weight' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'tags.*' => [
                'integer',
            ],
            'tags' => [
                'array',
            ],
            'affected_svg_state' => [
                'string',
                'nullable',
            ],
        ];
    }
}
