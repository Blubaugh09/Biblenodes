@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.verseConnection.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.verse-connections.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="verses">{{ trans('cruds.verseConnection.fields.verses') }}</label>
                <input class="form-control {{ $errors->has('verses') ? 'is-invalid' : '' }}" type="text" name="verses" id="verses" value="{{ old('verses', '') }}">
                @if($errors->has('verses'))
                    <div class="invalid-feedback">
                        {{ $errors->first('verses') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.verseConnection.fields.verses_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nodes">{{ trans('cruds.verseConnection.fields.nodes') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('nodes') ? 'is-invalid' : '' }}" name="nodes[]" id="nodes" multiple>
                    @foreach($nodes as $id => $node)
                        <option value="{{ $id }}" {{ in_array($id, old('nodes', [])) ? 'selected' : '' }}>{{ $node }}</option>
                    @endforeach
                </select>
                @if($errors->has('nodes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nodes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.verseConnection.fields.nodes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.verseConnection.fields.user') }}</label>
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
                <span class="help-block">{{ trans('cruds.verseConnection.fields.user_helper') }}</span>
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