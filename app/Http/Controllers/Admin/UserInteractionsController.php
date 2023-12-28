<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserInteractionRequest;
use App\Http\Requests\StoreUserInteractionRequest;
use App\Http\Requests\UpdateUserInteractionRequest;
use App\Models\User;
use App\Models\UserInteraction;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserInteractionsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_interaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userInteractions = UserInteraction::with(['user'])->get();

        return view('admin.userInteractions.index', compact('userInteractions'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_interaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userInteractions.create', compact('users'));
    }

    public function store(StoreUserInteractionRequest $request)
    {
        $userInteraction = UserInteraction::create($request->all());

        return redirect()->route('admin.user-interactions.index');
    }

    public function edit(UserInteraction $userInteraction)
    {
        abort_if(Gate::denies('user_interaction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userInteraction->load('user');

        return view('admin.userInteractions.edit', compact('userInteraction', 'users'));
    }

    public function update(UpdateUserInteractionRequest $request, UserInteraction $userInteraction)
    {
        $userInteraction->update($request->all());

        return redirect()->route('admin.user-interactions.index');
    }

    public function show(UserInteraction $userInteraction)
    {
        abort_if(Gate::denies('user_interaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userInteraction->load('user');

        return view('admin.userInteractions.show', compact('userInteraction'));
    }

    public function destroy(UserInteraction $userInteraction)
    {
        abort_if(Gate::denies('user_interaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userInteraction->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserInteractionRequest $request)
    {
        $userInteractions = UserInteraction::find(request('ids'));

        foreach ($userInteractions as $userInteraction) {
            $userInteraction->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
