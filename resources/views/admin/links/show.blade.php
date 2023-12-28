@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.link.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.links.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.link.fields.id') }}
                        </th>
                        <td>
                            {{ $link->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.link.fields.from_node') }}
                        </th>
                        <td>
                            {{ $link->from_node->text ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.link.fields.to_node') }}
                        </th>
                        <td>
                            {{ $link->to_node->text ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.link.fields.label') }}
                        </th>
                        <td>
                            {{ $link->label }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.link.fields.connection_type') }}
                        </th>
                        <td>
                            {{ $link->connection_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.link.fields.weight') }}
                        </th>
                        <td>
                            {{ $link->weight }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.link.fields.show_text_on_click') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $link->show_text_on_click ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.link.fields.user_created') }}
                        </th>
                        <td>
                            {{ $link->user_created->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.link.fields.tags') }}
                        </th>
                        <td>
                            @foreach($link->tags as $key => $tags)
                                <span class="label label-info">{{ $tags->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.link.fields.affect_node') }}
                        </th>
                        <td>
                            {{ $link->affect_node->text ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.link.fields.affected_svg_state') }}
                        </th>
                        <td>
                            {{ $link->affected_svg_state }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.links.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#links_bible_pathways" role="tab" data-toggle="tab">
                {{ trans('cruds.biblePathway.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="links_bible_pathways">
            @includeIf('admin.links.relationships.linksBiblePathways', ['biblePathways' => $link->linksBiblePathways])
        </div>
    </div>
</div>

@endsection