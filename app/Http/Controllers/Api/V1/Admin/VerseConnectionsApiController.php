<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVerseConnectionRequest;
use App\Http\Requests\UpdateVerseConnectionRequest;
use App\Http\Resources\Admin\VerseConnectionResource;
use App\Models\VerseConnection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerseConnectionsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('verse_connection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VerseConnectionResource(VerseConnection::with(['nodes', 'user'])->get());
    }

    public function store(StoreVerseConnectionRequest $request)
    {
        $verseConnection = VerseConnection::create($request->all());
        $verseConnection->nodes()->sync($request->input('nodes', []));

        return (new VerseConnectionResource($verseConnection))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(VerseConnection $verseConnection)
    {
        abort_if(Gate::denies('verse_connection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VerseConnectionResource($verseConnection->load(['nodes', 'user']));
    }

    public function update(UpdateVerseConnectionRequest $request, VerseConnection $verseConnection)
    {
        $verseConnection->update($request->all());
        $verseConnection->nodes()->sync($request->input('nodes', []));

        return (new VerseConnectionResource($verseConnection))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(VerseConnection $verseConnection)
    {
        abort_if(Gate::denies('verse_connection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $verseConnection->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
