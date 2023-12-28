@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.verseConnectionLink.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.verse-connection-links.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="link_id">{{ trans('cruds.verseConnectionLink.fields.link') }}</label>
                <select class="form-control select2 {{ $errors->has('link') ? 'is-invalid' : '' }}" name="link_id" id="link_id">
                    @foreach($links as $id => $entry)
                        <option value="{{ $id }}" {{ old('link_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.verseConnectionLink.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="verse">{{ trans('cruds.verseConnectionLink.fields.verse') }}</label>
                <input class="form-control {{ $errors->has('verse') ? 'is-invalid' : '' }}" type="text" name="verse" id="verse" value="{{ old('verse', '') }}">
                @if($errors->has('verse'))
                    <div class="invalid-feedback">
                        {{ $errors->first('verse') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.verseConnectionLink.fields.verse_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.verseConnectionLink.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.verseConnectionLink.fields.user_helper') }}</span>
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