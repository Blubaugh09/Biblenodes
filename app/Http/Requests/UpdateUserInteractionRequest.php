<?php

namespace App\Http\Requests;

use App\Models\UserInteraction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserInteractionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_interaction_edit');
    }

    public function rules()
    {
        return [
            'node_or_link_number' => [
                'string',
                'nullable',
            ],
            'type' => [
                'string',
                'nullable',
            ],
        ];
    }
}
