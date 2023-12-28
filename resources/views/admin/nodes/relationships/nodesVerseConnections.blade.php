@can('verse_connection_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.verse-connections.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.verseConnection.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.verseConnection.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-nodesVerseConnections">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.verseConnection.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.verseConnection.fields.verses') }}
                        </th>
                        <th>
                            {{ trans('cruds.verseConnection.fields.nodes') }}
                        </th>
                        <th>
                            {{ trans('cruds.verseConnection.fields.user') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($verseConnections as $key => $verseConnection)
                        <tr data-entry-id="{{ $verseConnection->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $verseConnection->id ?? '' }}
                            </td>
                            <td>
                                {{ $verseConnection->verses ?? '' }}
                            </td>
                            <td>
                                @foreach($verseConnection->nodes as $key => $item)
                                    <span class="badge badge-info">{{ $item->text }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $verseConnection->user->name ?? '' }}
                            </td>
                            <td>
                                @can('verse_connection_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.verse-connections.show', $verseConnection->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('verse_connection_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.verse-connections.edit', $verseConnection->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('verse_connection_delete')
                                    <form action="{{ route('admin.verse-connections.destroy', $verseConnection->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('verse_connection_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.verse-connections.massDestroy') }}",
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
  let table = $('.datatable-nodesVerseConnections:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection