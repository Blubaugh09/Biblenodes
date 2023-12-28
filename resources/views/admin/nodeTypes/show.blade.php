@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.nodeType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.node-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeType.fields.id') }}
                        </th>
                        <td>
                            {{ $nodeType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeType.fields.shape') }}
                        </th>
                        <td>
                            {{ $nodeType->shape }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeType.fields.color') }}
                        </th>
                        <td>
                            {{ $nodeType->color }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeType.fields.type') }}
                        </th>
                        <td>
                            {{ $nodeType->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeType.fields.text_color') }}
                        </th>
                        <td>
                            {{ $nodeType->text_color }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeType.fields.font_size') }}
                        </th>
                        <td>
                            {{ $nodeType->font_size }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeType.fields.visibility') }}
                        </th>
                        <td>
                            {{ $nodeType->visibility }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeType.fields.weight') }}
                        </th>
                        <td>
                            {{ $nodeType->weight }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeType.fields.icon_url') }}
                        </th>
                        <td>
                            {{ $nodeType->icon_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeType.fields.event') }}
                        </th>
                        <td>
                            {{ $nodeType->event }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeType.fields.node') }}
                        </th>
                        <td>
                            {{ $nodeType->node }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeType.fields.url') }}
                        </th>
                        <td>
                            @if($nodeType->url)
                                <a href="{{ $nodeType->url->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.node-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection