<?php

namespace App\Http\Requests;

use App\Models\NodeImage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNodeImageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('node_image_create');
    }

    public function rules()
    {
        return [
            'image_url' => [
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
