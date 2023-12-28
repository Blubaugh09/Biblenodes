@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userInteraction.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-interactions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userInteraction.fields.id') }}
                        </th>
                        <td>
                            {{ $userInteraction->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userInteraction.fields.user') }}
                        </th>
                        <td>
                            {{ $userInteraction->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userInteraction.fields.node_or_link_number') }}
                        </th>
                        <td>
                            {{ $userInteraction->node_or_link_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userInteraction.fields.type') }}
                        </th>
                        <td>
                            {{ $userInteraction->type }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-interactions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection