@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.verseConnectionLink.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.verse-connection-links.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.verseConnectionLink.fields.id') }}
                        </th>
                        <td>
                            {{ $verseConnectionLink->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.verseConnectionLink.fields.link') }}
                        </th>
                        <td>
                            {{ $verseConnectionLink->link->label ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.verseConnectionLink.fields.verse') }}
                        </th>
                        <td>
                            {{ $verseConnectionLink->verse }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.verseConnectionLink.fields.user') }}
                        </th>
                        <td>
                            {{ $verseConnectionLink->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.verse-connection-links.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection