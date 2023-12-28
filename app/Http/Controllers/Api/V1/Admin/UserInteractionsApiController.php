<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserInteractionRequest;
use App\Http\Requests\UpdateUserInteractionRequest;
use App\Http\Resources\Admin\UserInteractionResource;
use App\Models\UserInteraction;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserInteractionsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_interaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserInteractionResource(UserInteraction::with(['user'])->get());
    }

    public function store(StoreUserInteractionRequest $request)
    {
        $userInteraction = UserInteraction::create($request->all());

        return (new UserInteractionResource($userInteraction))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(UserInteraction $userInteraction)
    {
        abort_if(Gate::denies('user_interaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserInteractionResource($userInteraction->load(['user']));
    }

    public function update(UpdateUserInteractionRequest $request, UserInteraction $userInteraction)
    {
        $userInteraction->update($request->all());

        return (new UserInteractionResource($userInteraction))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(UserInteraction $userInteraction)
    {
        abort_if(Gate::denies('user_interaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userInteraction->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
