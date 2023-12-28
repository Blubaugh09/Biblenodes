@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.link.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.links.update", [$link->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="from_node_id">{{ trans('cruds.link.fields.from_node') }}</label>
                <select class="form-control select2 {{ $errors->has('from_node') ? 'is-invalid' : '' }}" name="from_node_id" id="from_node_id">
                    @foreach($from_nodes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('from_node_id') ? old('from_node_id') : $link->from_node->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('from_node'))
                    <div class="invalid-feedback">
                        {{ $errors->first('from_node') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.link.fields.from_node_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="to_node_id">{{ trans('cruds.link.fields.to_node') }}</label>
                <select class="form-control select2 {{ $errors->has('to_node') ? 'is-invalid' : '' }}" name="to_node_id" id="to_node_id">
                    @foreach($to_nodes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('to_node_id') ? old('to_node_id') : $link->to_node->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('to_node'))
                    <div class="invalid-feedback">
                        {{ $errors->first('to_node') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.link.fields.to_node_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="label">{{ trans('cruds.link.fields.label') }}</label>
                <input class="form-control {{ $errors->has('label') ? 'is-invalid' : '' }}" type="text" name="label" id="label" value="{{ old('label', $link->label) }}">
                @if($errors->has('label'))
                    <div class="invalid-feedback">
                        {{ $errors->first('label') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.link.fields.label_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="connection_type">{{ trans('cruds.link.fields.connection_type') }}</label>
                <input class="form-control {{ $errors->has('connection_type') ? 'is-invalid' : '' }}" type="text" name="connection_type" id="connection_type" value="{{ old('connection_type', $link->connection_type) }}">
                @if($errors->has('connection_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('connection_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.link.fields.connection_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="weight">{{ trans('cruds.link.fields.weight') }}</label>
                <input class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}" type="number" name="weight" id="weight" value="{{ old('weight', $link->weight) }}" step="1">
                @if($errors->has('weight'))
                    <div class="invalid-feedback">
                        {{ $errors->first('weight') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.link.fields.weight_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('show_text_on_click') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="show_text_on_click" value="0">
                    <input class="form-check-input" type="checkbox" name="show_text_on_click" id="show_text_on_click" value="1" {{ $link->show_text_on_click || old('show_text_on_click', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_text_on_click">{{ trans('cruds.link.fields.show_text_on_click') }}</label>
                </div>
                @if($errors->has('show_text_on_click'))
                    <div class="invalid-feedback">
                        {{ $errors->first('show_text_on_click') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.link.fields.show_text_on_click_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_created_id">{{ trans('cruds.link.fields.user_created') }}</label>
                <select class="form-control select2 {{ $errors->has('user_created') ? 'is-invalid' : '' }}" name="user_created_id" id="user_created_id">
                    @foreach($user_createds as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_created_id') ? old('user_created_id') : $link->user_created->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_created'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_created') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.link.fields.user_created_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.link.fields.tags') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $link->tags->contains($id)) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tags') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.link.fields.tags_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="affect_node_id">{{ trans('cruds.link.fields.affect_node') }}</label>
                <select class="form-control select2 {{ $errors->has('affect_node') ? 'is-invalid' : '' }}" name="affect_node_id" id="affect_node_id">
                    @foreach($affect_nodes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('affect_node_id') ? old('affect_node_id') : $link->affect_node->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('affect_node'))
                    <div class="invalid-feedback">
                        {{ $errors->first('affect_node') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.link.fields.affect_node_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="affected_svg_state">{{ trans('cruds.link.fields.affected_svg_state') }}</label>
                <input class="form-control {{ $errors->has('affected_svg_state') ? 'is-invalid' : '' }}" type="text" name="affected_svg_state" id="affected_svg_state" value="{{ old('affected_svg_state', $link->affected_svg_state) }}">
                @if($errors->has('affected_svg_state'))
                    <div class="invalid-feedback">
                        {{ $errors->first('affected_svg_state') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.link.fields.affected_svg_state_helper') }}</span>
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