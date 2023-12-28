@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.nodeImage.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.node-images.update", [$nodeImage->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="image_url">{{ trans('cruds.nodeImage.fields.image_url') }}</label>
                <input class="form-control {{ $errors->has('image_url') ? 'is-invalid' : '' }}" type="text" name="image_url" id="image_url" value="{{ old('image_url', $nodeImage->image_url) }}">
                @if($errors->has('image_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nodeImage.fields.image_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="node">{{ trans('cruds.nodeImage.fields.node') }}</label>
                <input class="form-control {{ $errors->has('node') ? 'is-invalid' : '' }}" type="text" name="node" id="node" value="{{ old('node', $nodeImage->node) }}">
                @if($errors->has('node'))
                    <div class="invalid-feedback">
                        {{ $errors->first('node') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nodeImage.fields.node_helper') }}</span>
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