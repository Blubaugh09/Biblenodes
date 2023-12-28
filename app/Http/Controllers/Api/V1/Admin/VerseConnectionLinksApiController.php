<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVerseConnectionLinkRequest;
use App\Http\Requests\UpdateVerseConnectionLinkRequest;
use App\Http\Resources\Admin\VerseConnectionLinkResource;
use App\Models\VerseConnectionLink;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerseConnectionLinksApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('verse_connection_link_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VerseConnectionLinkResource(VerseConnectionLink::with(['link', 'user'])->get());
    }

    public function store(StoreVerseConnectionLinkRequest $request)
    {
        $verseConnectionLink = VerseConnectionLink::create($request->all());

        return (new VerseConnectionLinkResource($verseConnectionLink))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(VerseConnectionLink $verseConnectionLink)
    {
        abort_if(Gate::denies('verse_connection_link_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VerseConnectionLinkResource($verseConnectionLink->load(['link', 'user']));
    }

    public function update(UpdateVerseConnectionLinkRequest $request, VerseConnectionLink $verseConnectionLink)
    {
        $verseConnectionLink->update($request->all());

        return (new VerseConnectionLinkResource($verseConnectionLink))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(VerseConnectionLink $verseConnectionLink)
    {
        abort_if(Gate::denies('verse_connection_link_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $verseConnectionLink->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
