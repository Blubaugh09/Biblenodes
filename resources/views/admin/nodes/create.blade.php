@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.node.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.nodes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="text">{{ trans('cruds.node.fields.text') }}</label>
                <input class="form-control {{ $errors->has('text') ? 'is-invalid' : '' }}" type="text" name="text" id="text" value="{{ old('text', '') }}">
                @if($errors->has('text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.node.fields.text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gender">{{ trans('cruds.node.fields.gender') }}</label>
                <input class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" type="text" name="gender" id="gender" value="{{ old('gender', '') }}">
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.node.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="weight">{{ trans('cruds.node.fields.weight') }}</label>
                <input class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}" type="number" name="weight" id="weight" value="{{ old('weight', '') }}" step="1">
                @if($errors->has('weight'))
                    <div class="invalid-feedback">
                        {{ $errors->first('weight') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.node.fields.weight_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('show_text_on_click') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="show_text_on_click" value="0">
                    <input class="form-check-input" type="checkbox" name="show_text_on_click" id="show_text_on_click" value="1" {{ old('show_text_on_click', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_text_on_click">{{ trans('cruds.node.fields.show_text_on_click') }}</label>
                </div>
                @if($errors->has('show_text_on_click'))
                    <div class="invalid-feedback">
                        {{ $errors->first('show_text_on_click') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.node.fields.show_text_on_click_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="object_type">{{ trans('cruds.node.fields.object_type') }}</label>
                <input class="form-control {{ $errors->has('object_type') ? 'is-invalid' : '' }}" type="text" name="object_type" id="object_type" value="{{ old('object_type', '') }}">
                @if($errors->has('object_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('object_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.node.fields.object_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.node.fields.user') }}</label>
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
                <span class="help-block">{{ trans('cruds.node.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.node.fields.tags') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tags') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.node.fields.tags_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="default_node_image">{{ trans('cruds.node.fields.default_node_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('default_node_image') ? 'is-invalid' : '' }}" id="default_node_image-dropzone">
                </div>
                @if($errors->has('default_node_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('default_node_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.node.fields.default_node_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="other_node_images">{{ trans('cruds.node.fields.other_node_images') }}</label>
                <div class="needsclick dropzone {{ $errors->has('other_node_images') ? 'is-invalid' : '' }}" id="other_node_images-dropzone">
                </div>
                @if($errors->has('other_node_images'))
                    <div class="invalid-feedback">
                        {{ $errors->first('other_node_images') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.node.fields.other_node_images_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="location">{{ trans('cruds.node.fields.location') }}</label>
                <input class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" type="text" name="location" id="location" value="{{ old('location', '') }}">
                @if($errors->has('location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.node.fields.location_helper') }}</span>
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
    Dropzone.options.defaultNodeImageDropzone = {
    url: '{{ route('admin.nodes.storeMedia') }}',
    maxFilesize: 10, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').find('input[name="default_node_image"]').remove()
      $('form').append('<input type="hidden" name="default_node_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="default_node_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($node) && $node->default_node_image)
      var file = {!! json_encode($node->default_node_image) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="default_node_image" value="' + file.file_name + '">')
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
<script>
    var uploadedOtherNodeImagesMap = {}
Dropzone.options.otherNodeImagesDropzone = {
    url: '{{ route('admin.nodes.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="other_node_images[]" value="' + response.name + '">')
      uploadedOtherNodeImagesMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedOtherNodeImagesMap[file.name]
      }
      $('form').find('input[name="other_node_images[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($node) && $node->other_node_images)
          var files =
            {!! json_encode($node->other_node_images) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="other_node_images[]" value="' + file.file_name + '">')
            }
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