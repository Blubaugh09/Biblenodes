<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVerseConnectionLinkRequest;
use App\Http\Requests\StoreVerseConnectionLinkRequest;
use App\Http\Requests\UpdateVerseConnectionLinkRequest;
use App\Models\Link;
use App\Models\User;
use App\Models\VerseConnectionLink;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerseConnectionLinksController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('verse_connection_link_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $verseConnectionLinks = VerseConnectionLink::with(['link', 'user'])->get();

        return view('admin.verseConnectionLinks.index', compact('verseConnectionLinks'));
    }

    public function create()
    {
        abort_if(Gate::denies('verse_connection_link_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $links = Link::pluck('label', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.verseConnectionLinks.create', compact('links', 'users'));
    }

    public function store(StoreVerseConnectionLinkRequest $request)
    {
        $verseConnectionLink = VerseConnectionLink::create($request->all());

        return redirect()->route('admin.verse-connection-links.index');
    }

    public function edit(VerseConnectionLink $verseConnectionLink)
    {
        abort_if(Gate::denies('verse_connection_link_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $links = Link::pluck('label', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $verseConnectionLink->load('link', 'user');

        return view('admin.verseConnectionLinks.edit', compact('links', 'users', 'verseConnectionLink'));
    }

    public function update(UpdateVerseConnectionLinkRequest $request, VerseConnectionLink $verseConnectionLink)
    {
        $verseConnectionLink->update($request->all());

        return redirect()->route('admin.verse-connection-links.index');
    }

    public function show(VerseConnectionLink $verseConnectionLink)
    {
        abort_if(Gate::denies('verse_connection_link_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $verseConnectionLink->load('link', 'user');

        return view('admin.verseConnectionLinks.show', compact('verseConnectionLink'));
    }

    public function destroy(VerseConnectionLink $verseConnectionLink)
    {
        abort_if(Gate::denies('verse_connection_link_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $verseConnectionLink->delete();

        return back();
    }

    public function massDestroy(MassDestroyVerseConnectionLinkRequest $request)
    {
        $verseConnectionLinks = VerseConnectionLink::find(request('ids'));

        foreach ($verseConnectionLinks as $verseConnectionLink) {
            $verseConnectionLink->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
