@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.bookmark.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bookmarks.update", [$bookmark->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.bookmark.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $bookmark->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bookmark.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nodes_id">{{ trans('cruds.bookmark.fields.nodes') }}</label>
                <select class="form-control select2 {{ $errors->has('nodes') ? 'is-invalid' : '' }}" name="nodes_id" id="nodes_id">
                    @foreach($nodes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('nodes_id') ? old('nodes_id') : $bookmark->nodes->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nodes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nodes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bookmark.fields.nodes_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection