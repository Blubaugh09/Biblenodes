<?php

namespace App\Http\Requests;

use App\Models\VerseConnection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVerseConnectionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('verse_connection_edit');
    }

    public function rules()
    {
        return [
            'verses' => [
                'string',
                'nullable',
            ],
            'nodes.*' => [
                'integer',
            ],
            'nodes' => [
                'array',
            ],
        ];
    }
}
