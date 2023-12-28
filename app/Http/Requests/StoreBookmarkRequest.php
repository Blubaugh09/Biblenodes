<?php

namespace App\Http\Requests;

use App\Models\Bookmark;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBookmarkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bookmark_create');
    }

    public function rules()
    {
        return [];
    }
}
