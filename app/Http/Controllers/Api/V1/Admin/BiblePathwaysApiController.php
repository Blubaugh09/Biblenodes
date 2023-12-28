<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBiblePathwayRequest;
use App\Http\Requests\UpdateBiblePathwayRequest;
use App\Http\Resources\Admin\BiblePathwayResource;
use App\Models\BiblePathway;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BiblePathwaysApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bible_pathway_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BiblePathwayResource(BiblePathway::with(['user', 'tags', 'categories', 'links', 'diagram_type', 'root_node', 'double_tree_left_node', 'double_tree_right_node', 'sankey_start_node', 'sankey_end_node'])->get());
    }

    public function store(StoreBiblePathwayRequest $request)
    {
        $biblePathway = BiblePathway::create($request->all());
        $biblePathway->tags()->sync($request->input('tags', []));
        $biblePathway->categories()->sync($request->input('categories', []));
        $biblePathway->links()->sync($request->input('links', []));

        return (new BiblePathwayResource($biblePathway))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BiblePathway $biblePathway)
    {
        abort_if(Gate::denies('bible_pathway_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BiblePathwayResource($biblePathway->load(['user', 'tags', 'categories', 'links', 'diagram_type', 'root_node', 'double_tree_left_node', 'double_tree_right_node', 'sankey_start_node', 'sankey_end_node']));
    }

    public function update(UpdateBiblePathwayRequest $request, BiblePathway $biblePathway)
    {
        $biblePathway->update($request->all());
        $biblePathway->tags()->sync($request->input('tags', []));
        $biblePathway->categories()->sync($request->input('categories', []));
        $biblePathway->links()->sync($request->input('links', []));

        return (new BiblePathwayResource($biblePathway))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BiblePathway $biblePathway)
    {
        abort_if(Gate::denies('bible_pathway_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $biblePathway->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
