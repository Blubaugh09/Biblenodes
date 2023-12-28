<?php

namespace App\Http\Requests;

use App\Models\BiblePathway;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBiblePathwayRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bible_pathway_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bible_pathways,id',
        ];
    }
}
