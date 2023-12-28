<?php

namespace App\Http\Requests;

use App\Models\BiblePathway;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBiblePathwayRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bible_pathway_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'tags.*' => [
                'integer',
            ],
            'tags' => [
                'array',
            ],
            'categories.*' => [
                'integer',
            ],
            'categories' => [
                'array',
            ],
            'links.*' => [
                'integer',
            ],
            'links' => [
                'array',
            ],
            'link_for_pathway' => [
                'string',
                'nullable',
            ],
        ];
    }
}
