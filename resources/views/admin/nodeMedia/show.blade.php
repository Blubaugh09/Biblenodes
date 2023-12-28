@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.nodeMedium.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.node-media.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeMedium.fields.id') }}
                        </th>
                        <td>
                            {{ $nodeMedium->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeMedium.fields.title') }}
                        </th>
                        <td>
                            {{ $nodeMedium->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeMedium.fields.nodes_related_to') }}
                        </th>
                        <td>
                            @foreach($nodeMedium->nodes_related_tos as $key => $nodes_related_to)
                                <span class="label label-info">{{ $nodes_related_to->text }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeMedium.fields.media_type') }}
                        </th>
                        <td>
                            {{ $nodeMedium->media_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeMedium.fields.link') }}
                        </th>
                        <td>
                            {{ $nodeMedium->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeMedium.fields.image') }}
                        </th>
                        <td>
                            @foreach($nodeMedium->image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.node-media.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection