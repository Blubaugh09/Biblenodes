@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.nodeType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.node-types.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="shape">{{ trans('cruds.nodeType.fields.shape') }}</label>
                <input class="form-control {{ $errors->has('shape') ? 'is-invalid' : '' }}" type="text" name="shape" id="shape" value="{{ old('shape', '') }}">
                @if($errors->has('shape'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shape') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nodeType.fields.shape_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="color">{{ trans('cruds.nodeType.fields.color') }}</label>
                <input class="form-control {{ $errors->has('color') ? 'is-invalid' : '' }}" type="text" name="color" id="color" value="{{ old('color', '') }}">
                @if($errors->has('color'))
                    <div class="invalid-feedback">
                        {{ $errors->first('color') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nodeType.fields.color_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="type">{{ trans('cruds.nodeType.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', '') }}">
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nodeType.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="text_color">{{ trans('cruds.nodeType.fields.text_color') }}</label>
                <input class="form-control {{ $errors->has('text_color') ? 'is-invalid' : '' }}" type="text" name="text_color" id="text_color" value="{{ old('text_color', '') }}">
                @if($errors->has('text_color'))
                    <div class="invalid-feedback">
                        {{ $errors->first('text_color') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nodeType.fields.text_color_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="font_size">{{ trans('cruds.nodeType.fields.font_size') }}</label>
                <input class="form-control {{ $errors->has('font_size') ? 'is-invalid' : '' }}" type="text" name="font_size" id="font_size" value="{{ old('font_size', '') }}">
                @if($errors->has('font_size'))
                    <div class="invalid-feedback">
                        {{ $errors->first('font_size') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nodeType.fields.font_size_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="visibility">{{ trans('cruds.nodeType.fields.visibility') }}</label>
                <input class="form-control {{ $errors->has('visibility') ? 'is-invalid' : '' }}" type="text" name="visibility" id="visibility" value="{{ old('visibility', '') }}">
                @if($errors->has('visibility'))
                    <div class="invalid-feedback">
                        {{ $errors->first('visibility') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nodeType.fields.visibility_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="weight">{{ trans('cruds.nodeType.fields.weight') }}</label>
                <input class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}" type="text" name="weight" id="weight" value="{{ old('weight', '') }}">
                @if($errors->has('weight'))
                    <div class="invalid-feedback">
                        {{ $errors->first('weight') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nodeType.fields.weight_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="icon_url">{{ trans('cruds.nodeType.fields.icon_url') }}</label>
                <input class="form-control {{ $errors->has('icon_url') ? 'is-invalid' : '' }}" type="text" name="icon_url" id="icon_url" value="{{ old('icon_url', '') }}">
                @if($errors->has('icon_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('icon_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nodeType.fields.icon_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="event">{{ trans('cruds.nodeType.fields.event') }}</label>
                <input class="form-control {{ $errors->has('event') ? 'is-invalid' : '' }}" type="text" name="event" id="event" value="{{ old('event', '') }}">
                @if($errors->has('event'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nodeType.fields.event_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="node">{{ trans('cruds.nodeType.fields.node') }}</label>
                <input class="form-control {{ $errors->has('node') ? 'is-invalid' : '' }}" type="text" name="node" id="node" value="{{ old('node', '') }}">
                @if($errors->has('node'))
                    <div class="invalid-feedback">
                        {{ $errors->first('node') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nodeType.fields.node_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="url">{{ trans('cruds.nodeType.fields.url') }}</label>
                <div class="needsclick dropzone {{ $errors->has('url') ? 'is-invalid' : '' }}" id="url-dropzone">
                </div>
                @if($errors->has('url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nodeType.fields.url_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.urlDropzone = {
    url: '{{ route('admin.node-types.storeMedia') }}',
    maxFilesize: 30, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 30
    },
    success: function (file, response) {
      $('form').find('input[name="url"]').remove()
      $('form').append('<input type="hidden" name="url" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="url"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($nodeType) && $nodeType->url)
      var file = {!! json_encode($nodeType->url) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="url" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection