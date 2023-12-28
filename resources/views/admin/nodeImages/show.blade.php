@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.nodeImage.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.node-images.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeImage.fields.id') }}
                        </th>
                        <td>
                            {{ $nodeImage->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeImage.fields.image_url') }}
                        </th>
                        <td>
                            {{ $nodeImage->image_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nodeImage.fields.node') }}
                        </th>
                        <td>
                            {{ $nodeImage->node }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.node-images.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection