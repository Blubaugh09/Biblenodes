<?php

namespace App\Http\Requests;

use App\Models\VerseConnectionLink;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVerseConnectionLinkRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('verse_connection_link_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:verse_connection_links,id',
        ];
    }
}
