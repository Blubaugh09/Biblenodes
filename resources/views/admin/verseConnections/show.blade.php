@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.verseConnection.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.verse-connections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.verseConnection.fields.id') }}
                        </th>
                        <td>
                            {{ $verseConnection->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.verseConnection.fields.verses') }}
                        </th>
                        <td>
                            {{ $verseConnection->verses }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.verseConnection.fields.nodes') }}
                        </th>
                        <td>
                            @foreach($verseConnection->nodes as $key => $nodes)
                                <span class="label label-info">{{ $nodes->text }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.verseConnection.fields.user') }}
                        </th>
                        <td>
                            {{ $verseConnection->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.verse-connections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection