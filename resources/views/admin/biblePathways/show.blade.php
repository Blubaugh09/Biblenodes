@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.biblePathway.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bible-pathways.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.biblePathway.fields.id') }}
                        </th>
                        <td>
                            {{ $biblePathway->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.biblePathway.fields.title') }}
                        </th>
                        <td>
                            {{ $biblePathway->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.biblePathway.fields.description') }}
                        </th>
                        <td>
                            {{ $biblePathway->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.biblePathway.fields.user') }}
                        </th>
                        <td>
                            {{ $biblePathway->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.biblePathway.fields.tags') }}
                        </th>
                        <td>
                            @foreach($biblePathway->tags as $key => $tags)
                                <span class="label label-info">{{ $tags->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.biblePathway.fields.categories') }}
                        </th>
                        <td>
                            @foreach($biblePathway->categories as $key => $categories)
                                <span class="label label-info">{{ $categories->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.biblePathway.fields.links') }}
                        </th>
                        <td>
                            @foreach($biblePathway->links as $key => $links)
                                <span class="label label-info">{{ $links->label }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.biblePathway.fields.diagram_type') }}
                        </th>
                        <td>
                            {{ $biblePathway->diagram_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.biblePathway.fields.root_node') }}
                        </th>
                        <td>
                            {{ $biblePathway->root_node->text ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.biblePathway.fields.double_tree_left_node') }}
                        </th>
                        <td>
                            {{ $biblePathway->double_tree_left_node->text ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.biblePathway.fields.double_tree_right_node') }}
                        </th>
                        <td>
                            {{ $biblePathway->double_tree_right_node->text ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.biblePathway.fields.sankey_start_node') }}
                        </th>
                        <td>
                            {{ $biblePathway->sankey_start_node->text ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.biblePathway.fields.sankey_end_node') }}
                        </th>
                        <td>
                            {{ $biblePathway->sankey_end_node->text ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.biblePathway.fields.link_for_pathway') }}
                        </th>
                        <td>
                            {{ $biblePathway->link_for_pathway }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bible-pathways.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection