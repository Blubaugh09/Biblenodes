@extends('layouts.admin')
@section('content')
@can('node_type_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.node-types.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.nodeType.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.nodeType.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-NodeType">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.nodeType.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.nodeType.fields.shape') }}
                        </th>
                        <th>
                            {{ trans('cruds.nodeType.fields.color') }}
                        </th>
                        <th>
                            {{ trans('cruds.nodeType.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.nodeType.fields.text_color') }}
                        </th>
                        <th>
                            {{ trans('cruds.nodeType.fields.font_size') }}
                        </th>
                        <th>
                            {{ trans('cruds.nodeType.fields.visibility') }}
                        </th>
                        <th>
                            {{ trans('cruds.nodeType.fields.weight') }}
                        </th>
                        <th>
                            {{ trans('cruds.nodeType.fields.icon_url') }}
                        </th>
                        <th>
                            {{ trans('cruds.nodeType.fields.event') }}
                        </th>
                        <th>
                            {{ trans('cruds.nodeType.fields.node') }}
                        </th>
                        <th>
                            {{ trans('cruds.nodeType.fields.url') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nodeTypes as $key => $nodeType)
                        <tr data-entry-id="{{ $nodeType->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $nodeType->id ?? '' }}
                            </td>
                            <td>
                                {{ $nodeType->shape ?? '' }}
                            </td>
                            <td>
                                {{ $nodeType->color ?? '' }}
                            </td>
                            <td>
                                {{ $nodeType->type ?? '' }}
                            </td>
                            <td>
                                {{ $nodeType->text_color ?? '' }}
                            </td>
                            <td>
                                {{ $nodeType->font_size ?? '' }}
                            </td>
                            <td>
                                {{ $nodeType->visibility ?? '' }}
                            </td>
                            <td>
                                {{ $nodeType->weight ?? '' }}
                            </td>
                            <td>
                                {{ $nodeType->icon_url ?? '' }}
                            </td>
                            <td>
                                {{ $nodeType->event ?? '' }}
                            </td>
                            <td>
                                {{ $nodeType->node ?? '' }}
                            </td>
                            <td>
                                @if($nodeType->url)
                                    <a href="{{ $nodeType->url->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('node_type_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.node-types.show', $nodeType->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('node_type_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.node-types.edit', $nodeType->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('node_type_delete')
                                    <form action="{{ route('admin.node-types.destroy', $nodeType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('node_type_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.node-types.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-NodeType:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection