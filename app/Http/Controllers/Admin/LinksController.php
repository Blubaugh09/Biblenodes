<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLinkRequest;
use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\ContentTag;
use App\Models\Link;
use App\Models\Node;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LinksController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('link_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $links = Link::with(['from_node', 'to_node', 'user_created', 'tags', 'affect_node'])->get();

        return view('admin.links.index', compact('links'));
    }

    public function create()
    {
        abort_if(Gate::denies('link_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $from_nodes = Node::pluck('text', 'id')->prepend(trans('global.pleaseSelect'), '');

        $to_nodes = Node::pluck('text', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_createds = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = ContentTag::pluck('name', 'id');

        $affect_nodes = Node::pluck('text', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.links.create', compact('affect_nodes', 'from_nodes', 'tags', 'to_nodes', 'user_createds'));
    }

    public function store(StoreLinkRequest $request)
    {
        $link = Link::create($request->all());
        $link->tags()->sync($request->input('tags', []));

        return redirect()->route('admin.links.index');
    }

    public function edit(Link $link)
    {
        abort_if(Gate::denies('link_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $from_nodes = Node::pluck('text', 'id')->prepend(trans('global.pleaseSelect'), '');

        $to_nodes = Node::pluck('text', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_createds = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = ContentTag::pluck('name', 'id');

        $affect_nodes = Node::pluck('text', 'id')->prepend(trans('global.pleaseSelect'), '');

        $link->load('from_node', 'to_node', 'user_created', 'tags', 'affect_node');

        return view('admin.links.edit', compact('affect_nodes', 'from_nodes', 'link', 'tags', 'to_nodes', 'user_createds'));
    }

    public function update(UpdateLinkRequest $request, Link $link)
    {
        $link->update($request->all());
        $link->tags()->sync($request->input('tags', []));

        return redirect()->route('admin.links.index');
    }

    public function show(Link $link)
    {
        abort_if(Gate::denies('link_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $link->load('from_node', 'to_node', 'user_created', 'tags', 'affect_node', 'linksBiblePathways');

        return view('admin.links.show', compact('link'));
    }

    public function destroy(Link $link)
    {
        abort_if(Gate::denies('link_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $link->delete();

        return back();
    }

    public function massDestroy(MassDestroyLinkRequest $request)
    {
        $links = Link::find(request('ids'));

        foreach ($links as $link) {
            $link->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
