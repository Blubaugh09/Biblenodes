@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.nodeMedium.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.node-media.update", [$nodeMedium->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="title">{{ trans('cruds.nodeMedium.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $nodeMedium->title) }}">
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nodeMedium.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nodes_related_tos">{{ trans('cruds.nodeMedium.fields.nodes_related_to') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('nodes_related_tos') ? 'is-invalid' : '' }}" name="nodes_related_tos[]" id="nodes_related_tos" multiple>
                    @foreach($nodes_related_tos as $id => $nodes_related_to)
                        <option value="{{ $id }}" {{ (in_array($id, old('nodes_related_tos', [])) || $nodeMedium->nodes_related_tos->contains($id)) ? 'selected' : '' }}>{{ $nodes_related_to }}</option>
                    @endforeach
                </select>
                @if($errors->has('nodes_related_tos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nodes_related_tos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nodeMedium.fields.nodes_related_to_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="media_type">{{ trans('cruds.nodeMedium.fields.media_type') }}</label>
                <input class="form-control {{ $errors->has('media_type') ? 'is-invalid' : '' }}" type="text" name="media_type" id="media_type" value="{{ old('media_type', $nodeMedium->media_type) }}">
                @if($errors->has('media_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('media_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nodeMedium.fields.media_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.nodeMedium.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', $nodeMedium->link) }}">
                @if($errors->has('link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nodeMedium.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.nodeMedium.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.nodeMedium.fields.image_helper') }}</span>
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
    var uploadedImageMap = {}
Dropzone.options.imageDropzone = {
    url: '{{ route('admin.node-media.storeMedia') }}',
    maxFilesize: 10, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="image[]" value="' + response.name + '">')
      uploadedImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedImageMap[file.name]
      }
      $('form').find('input[name="image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($nodeMedium) && $nodeMedium->image)
      var files = {!! json_encode($nodeMedium->image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="image[]" value="' + file.file_name + '">')
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