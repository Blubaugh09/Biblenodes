<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVerseConnectionRequest;
use App\Http\Requests\StoreVerseConnectionRequest;
use App\Http\Requests\UpdateVerseConnectionRequest;
use App\Models\Node;
use App\Models\User;
use App\Models\VerseConnection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerseConnectionsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('verse_connection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $verseConnections = VerseConnection::with(['nodes', 'user'])->get();

        return view('admin.verseConnections.index', compact('verseConnections'));
    }

    public function create()
    {
        abort_if(Gate::denies('verse_connection_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nodes = Node::pluck('text', 'id');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.verseConnections.create', compact('nodes', 'users'));
    }

    public function store(StoreVerseConnectionRequest $request)
    {
        $verseConnection = VerseConnection::create($request->all());
        $verseConnection->nodes()->sync($request->input('nodes', []));

        return redirect()->route('admin.verse-connections.index');
    }

    public function edit(VerseConnection $verseConnection)
    {
        abort_if(Gate::denies('verse_connection_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nodes = Node::pluck('text', 'id');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $verseConnection->load('nodes', 'user');

        return view('admin.verseConnections.edit', compact('nodes', 'users', 'verseConnection'));
    }

    public function update(UpdateVerseConnectionRequest $request, VerseConnection $verseConnection)
    {
        $verseConnection->update($request->all());
        $verseConnection->nodes()->sync($request->input('nodes', []));

        return redirect()->route('admin.verse-connections.index');
    }

    public function show(VerseConnection $verseConnection)
    {
        abort_if(Gate::denies('verse_connection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $verseConnection->load('nodes', 'user');

        return view('admin.verseConnections.show', compact('verseConnection'));
    }

    public function destroy(VerseConnection $verseConnection)
    {
        abort_if(Gate::denies('verse_connection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $verseConnection->delete();

        return back();
    }

    public function massDestroy(MassDestroyVerseConnectionRequest $request)
    {
        $verseConnections = VerseConnection::find(request('ids'));

        foreach ($verseConnections as $verseConnection) {
            $verseConnection->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
