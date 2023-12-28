@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.diagramType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.diagram-types.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.diagramType.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.diagramType.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="specialty_field">{{ trans('cruds.diagramType.fields.specialty_field') }}</label>
                <input class="form-control {{ $errors->has('specialty_field') ? 'is-invalid' : '' }}" type="text" name="specialty_field" id="specialty_field" value="{{ old('specialty_field', '') }}">
                @if($errors->has('specialty_field'))
                    <div class="invalid-feedback">
                        {{ $errors->first('specialty_field') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.diagramType.fields.specialty_field_helper') }}</span>
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