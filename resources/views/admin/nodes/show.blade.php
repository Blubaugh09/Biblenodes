@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.node.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.nodes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.node.fields.id') }}
                        </th>
                        <td>
                            {{ $node->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.node.fields.text') }}
                        </th>
                        <td>
                            {{ $node->text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.node.fields.gender') }}
                        </th>
                        <td>
                            {{ $node->gender }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.node.fields.weight') }}
                        </th>
                        <td>
                            {{ $node->weight }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.node.fields.show_text_on_click') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $node->show_text_on_click ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.node.fields.object_type') }}
                        </th>
                        <td>
                            {{ $node->object_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.node.fields.user') }}
                        </th>
                        <td>
                            {{ $node->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.node.fields.tags') }}
                        </th>
                        <td>
                            @foreach($node->tags as $key => $tags)
                                <span class="label label-info">{{ $tags->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.node.fields.default_node_image') }}
                        </th>
                        <td>
                            @if($node->default_node_image)
                                <a href="{{ $node->default_node_image->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.node.fields.other_node_images') }}
                        </th>
                        <td>
                            @foreach($node->other_node_images as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.node.fields.location') }}
                        </th>
                        <td>
                            {{ $node->location }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.nodes.index') }}">
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
            <a class="nav-link" href="#nodes_verse_connections" role="tab" data-toggle="tab">
                {{ trans('cruds.verseConnection.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#nodes_related_to_node_media" role="tab" data-toggle="tab">
                {{ trans('cruds.nodeMedium.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="nodes_verse_connections">
            @includeIf('admin.nodes.relationships.nodesVerseConnections', ['verseConnections' => $node->nodesVerseConnections])
        </div>
        <div class="tab-pane" role="tabpanel" id="nodes_related_to_node_media">
            @includeIf('admin.nodes.relationships.nodesRelatedToNodeMedia', ['nodeMedia' => $node->nodesRelatedToNodeMedia])
        </div>
    </div>
</div>

@endsection