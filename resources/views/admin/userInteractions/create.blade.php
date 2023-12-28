@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.userInteraction.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-interactions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.userInteraction.fields.user') }}</label>
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
                <span class="help-block">{{ trans('cruds.userInteraction.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="node_or_link_number">{{ trans('cruds.userInteraction.fields.node_or_link_number') }}</label>
                <input class="form-control {{ $errors->has('node_or_link_number') ? 'is-invalid' : '' }}" type="text" name="node_or_link_number" id="node_or_link_number" value="{{ old('node_or_link_number', '') }}">
                @if($errors->has('node_or_link_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('node_or_link_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userInteraction.fields.node_or_link_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="type">{{ trans('cruds.userInteraction.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', '') }}">
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userInteraction.fields.type_helper') }}</span>
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