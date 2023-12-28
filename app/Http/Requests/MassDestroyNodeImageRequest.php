<?php

namespace App\Http\Requests;

use App\Models\NodeImage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyNodeImageRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('node_image_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:node_images,id',
        ];
    }
}
