@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.biblePathway.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bible-pathways.update", [$biblePathway->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="title">{{ trans('cruds.biblePathway.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $biblePathway->title) }}">
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.biblePathway.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.biblePathway.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $biblePathway->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.biblePathway.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.biblePathway.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $biblePathway->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.biblePathway.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.biblePathway.fields.tags') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $biblePathway->tags->contains($id)) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tags') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.biblePathway.fields.tags_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="categories">{{ trans('cruds.biblePathway.fields.categories') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ (in_array($id, old('categories', [])) || $biblePathway->categories->contains($id)) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <div class="invalid-feedback">
                        {{ $errors->first('categories') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.biblePathway.fields.categories_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="links">{{ trans('cruds.biblePathway.fields.links') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('links') ? 'is-invalid' : '' }}" name="links[]" id="links" multiple>
                    @foreach($links as $id => $link)
                        <option value="{{ $id }}" {{ (in_array($id, old('links', [])) || $biblePathway->links->contains($id)) ? 'selected' : '' }}>{{ $link }}</option>
                    @endforeach
                </select>
                @if($errors->has('links'))
                    <div class="invalid-feedback">
                        {{ $errors->first('links') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.biblePathway.fields.links_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="diagram_type_id">{{ trans('cruds.biblePathway.fields.diagram_type') }}</label>
                <select class="form-control select2 {{ $errors->has('diagram_type') ? 'is-invalid' : '' }}" name="diagram_type_id" id="diagram_type_id">
                    @foreach($diagram_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('diagram_type_id') ? old('diagram_type_id') : $biblePathway->diagram_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('diagram_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('diagram_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.biblePathway.fields.diagram_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="root_node_id">{{ trans('cruds.biblePathway.fields.root_node') }}</label>
                <select class="form-control select2 {{ $errors->has('root_node') ? 'is-invalid' : '' }}" name="root_node_id" id="root_node_id">
                    @foreach($root_nodes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('root_node_id') ? old('root_node_id') : $biblePathway->root_node->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('root_node'))
                    <div class="invalid-feedback">
                        {{ $errors->first('root_node') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.biblePathway.fields.root_node_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="double_tree_left_node_id">{{ trans('cruds.biblePathway.fields.double_tree_left_node') }}</label>
                <select class="form-control select2 {{ $errors->has('double_tree_left_node') ? 'is-invalid' : '' }}" name="double_tree_left_node_id" id="double_tree_left_node_id">
                    @foreach($double_tree_left_nodes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('double_tree_left_node_id') ? old('double_tree_left_node_id') : $biblePathway->double_tree_left_node->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('double_tree_left_node'))
                    <div class="invalid-feedback">
                        {{ $errors->first('double_tree_left_node') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.biblePathway.fields.double_tree_left_node_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="double_tree_right_node_id">{{ trans('cruds.biblePathway.fields.double_tree_right_node') }}</label>
                <select class="form-control select2 {{ $errors->has('double_tree_right_node') ? 'is-invalid' : '' }}" name="double_tree_right_node_id" id="double_tree_right_node_id">
                    @foreach($double_tree_right_nodes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('double_tree_right_node_id') ? old('double_tree_right_node_id') : $biblePathway->double_tree_right_node->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('double_tree_right_node'))
                    <div class="invalid-feedback">
                        {{ $errors->first('double_tree_right_node') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.biblePathway.fields.double_tree_right_node_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sankey_start_node_id">{{ trans('cruds.biblePathway.fields.sankey_start_node') }}</label>
                <select class="form-control select2 {{ $errors->has('sankey_start_node') ? 'is-invalid' : '' }}" name="sankey_start_node_id" id="sankey_start_node_id">
                    @foreach($sankey_start_nodes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('sankey_start_node_id') ? old('sankey_start_node_id') : $biblePathway->sankey_start_node->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('sankey_start_node'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sankey_start_node') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.biblePathway.fields.sankey_start_node_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sankey_end_node_id">{{ trans('cruds.biblePathway.fields.sankey_end_node') }}</label>
                <select class="form-control select2 {{ $errors->has('sankey_end_node') ? 'is-invalid' : '' }}" name="sankey_end_node_id" id="sankey_end_node_id">
                    @foreach($sankey_end_nodes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('sankey_end_node_id') ? old('sankey_end_node_id') : $biblePathway->sankey_end_node->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('sankey_end_node'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sankey_end_node') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.biblePathway.fields.sankey_end_node_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_for_pathway">{{ trans('cruds.biblePathway.fields.link_for_pathway') }}</label>
                <input class="form-control {{ $errors->has('link_for_pathway') ? 'is-invalid' : '' }}" type="text" name="link_for_pathway" id="link_for_pathway" value="{{ old('link_for_pathway', $biblePathway->link_for_pathway) }}">
                @if($errors->has('link_for_pathway'))
                    <div class="invalid-feedback">
                        {{ $errors->first('link_for_pathway') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.biblePathway.fields.link_for_pathway_helper') }}</span>
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