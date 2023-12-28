@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.diagramType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.diagram-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.diagramType.fields.id') }}
                        </th>
                        <td>
                            {{ $diagramType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.diagramType.fields.name') }}
                        </th>
                        <td>
                            {{ $diagramType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.diagramType.fields.specialty_field') }}
                        </th>
                        <td>
                            {{ $diagramType->specialty_field }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.diagram-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection