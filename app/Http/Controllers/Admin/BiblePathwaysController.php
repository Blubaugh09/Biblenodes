<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBiblePathwayRequest;
use App\Http\Requests\StoreBiblePathwayRequest;
use App\Http\Requests\UpdateBiblePathwayRequest;
use App\Models\BiblePathway;
use App\Models\ContentCategory;
use App\Models\ContentTag;
use App\Models\DiagramType;
use App\Models\Link;
use App\Models\Node;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BiblePathwaysController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bible_pathway_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $biblePathways = BiblePathway::with(['user', 'tags', 'categories', 'links', 'diagram_type', 'root_node', 'double_tree_left_node', 'double_tree_right_node', 'sankey_start_node', 'sankey_end_node'])->get();

        return view('admin.biblePathways.index', compact('biblePathways'));
    }

    public function create()
    {
        abort_if(Gate::denies('bible_pathway_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = ContentTag::pluck('name', 'id');

        $categories = ContentCategory::pluck('name', 'id');

        $links = Link::pluck('label', 'id');

        $diagram_types = DiagramType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $root_nodes = Node::pluck('text', 'id')->prepend(trans('global.pleaseSelect'), '');

        $double_tree_left_nodes = Node::pluck('text', 'id')->prepend(trans('global.pleaseSelect'), '');

        $double_tree_right_nodes = Node::pluck('text', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sankey_start_nodes = Node::pluck('text', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sankey_end_nodes = Node::pluck('text', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.biblePathways.create', compact('categories', 'diagram_types', 'double_tree_left_nodes', 'double_tree_right_nodes', 'links', 'root_nodes', 'sankey_end_nodes', 'sankey_start_nodes', 'tags', 'users'));
    }

    public function store(StoreBiblePathwayRequest $request)
    {
        $biblePathway = BiblePathway::create($request->all());
        $biblePathway->tags()->sync($request->input('tags', []));
        $biblePathway->categories()->sync($request->input('categories', []));
        $biblePathway->links()->sync($request->input('links', []));

        return redirect()->route('admin.bible-pathways.index');
    }

    public function edit(BiblePathway $biblePathway)
    {
        abort_if(Gate::denies('bible_pathway_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = ContentTag::pluck('name', 'id');

        $categories = ContentCategory::pluck('name', 'id');

        $links = Link::pluck('label', 'id');

        $diagram_types = DiagramType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $root_nodes = Node::pluck('text', 'id')->prepend(trans('global.pleaseSelect'), '');

        $double_tree_left_nodes = Node::pluck('text', 'id')->prepend(trans('global.pleaseSelect'), '');

        $double_tree_right_nodes = Node::pluck('text', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sankey_start_nodes = Node::pluck('text', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sankey_end_nodes = Node::pluck('text', 'id')->prepend(trans('global.pleaseSelect'), '');

        $biblePathway->load('user', 'tags', 'categories', 'links', 'diagram_type', 'root_node', 'double_tree_left_node', 'double_tree_right_node', 'sankey_start_node', 'sankey_end_node');

        return view('admin.biblePathways.edit', compact('biblePathway', 'categories', 'diagram_types', 'double_tree_left_nodes', 'double_tree_right_nodes', 'links', 'root_nodes', 'sankey_end_nodes', 'sankey_start_nodes', 'tags', 'users'));
    }

    public function update(UpdateBiblePathwayRequest $request, BiblePathway $biblePathway)
    {
        $biblePathway->update($request->all());
        $biblePathway->tags()->sync($request->input('tags', []));
        $biblePathway->categories()->sync($request->input('categories', []));
        $biblePathway->links()->sync($request->input('links', []));

        return redirect()->route('admin.bible-pathways.index');
    }

    public function show(BiblePathway $biblePathway)
    {
        abort_if(Gate::denies('bible_pathway_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $biblePathway->load('user', 'tags', 'categories', 'links', 'diagram_type', 'root_node', 'double_tree_left_node', 'double_tree_right_node', 'sankey_start_node', 'sankey_end_node');

        return view('admin.biblePathways.show', compact('biblePathway'));
    }

    public function destroy(BiblePathway $biblePathway)
    {
        abort_if(Gate::denies('bible_pathway_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $biblePathway->delete();

        return back();
    }

    public function massDestroy(MassDestroyBiblePathwayRequest $request)
    {
        $biblePathways = BiblePathway::find(request('ids'));

        foreach ($biblePathways as $biblePathway) {
            $biblePathway->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
