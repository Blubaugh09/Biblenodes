<?php

namespace App\Http\Requests;

use App\Models\Bookmark;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBookmarkRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bookmark_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bookmarks,id',
        ];
    }
}
