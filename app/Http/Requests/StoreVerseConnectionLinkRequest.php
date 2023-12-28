<?php

namespace App\Http\Requests;

use App\Models\VerseConnectionLink;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVerseConnectionLinkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('verse_connection_link_create');
    }

    public function rules()
    {
        return [
            'verse' => [
                'string',
                'nullable',
            ],
        ];
    }
}
