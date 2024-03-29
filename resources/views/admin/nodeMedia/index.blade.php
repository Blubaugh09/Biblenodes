@extends('layouts.admin')
@section('content')
@can('node_medium_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.node-media.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.nodeMedium.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.nodeMedium.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-NodeMedium">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.nodeMedium.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.nodeMedium.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.nodeMedium.fields.nodes_related_to') }}
                        </th>
                        <th>
                            {{ trans('cruds.nodeMedium.fields.media_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.nodeMedium.fields.link') }}
                        </th>
                        <th>
                            {{ trans('cruds.nodeMedium.fields.image') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nodeMedia as $key => $nodeMedium)
                        <tr data-entry-id="{{ $nodeMedium->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $nodeMedium->id ?? '' }}
                            </td>
                            <td>
                                {{ $nodeMedium->title ?? '' }}
                            </td>
                            <td>
                                @foreach($nodeMedium->nodes_related_tos as $key => $item)
                                    <span class="badge badge-info">{{ $item->text }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $nodeMedium->media_type ?? '' }}
                            </td>
                            <td>
                                {{ $nodeMedium->link ?? '' }}
                            </td>
                            <td>
                                @foreach($nodeMedium->image as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @can('node_medium_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.node-media.show', $nodeMedium->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('node_medium_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.node-media.edit', $nodeMedium->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('node_medium_delete')
                                    <form action="{{ route('admin.node-media.destroy', $nodeMedium->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('node_medium_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.node-media.massDestroy') }}",
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
  let table = $('.datatable-NodeMedium:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection