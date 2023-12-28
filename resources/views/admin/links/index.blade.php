@extends('layouts.admin')
@section('content')
@can('link_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.links.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.link.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.link.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Link">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.link.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.link.fields.from_node') }}
                        </th>
                        <th>
                            {{ trans('cruds.link.fields.to_node') }}
                        </th>
                        <th>
                            {{ trans('cruds.link.fields.label') }}
                        </th>
                        <th>
                            {{ trans('cruds.link.fields.connection_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.link.fields.weight') }}
                        </th>
                        <th>
                            {{ trans('cruds.link.fields.show_text_on_click') }}
                        </th>
                        <th>
                            {{ trans('cruds.link.fields.user_created') }}
                        </th>
                        <th>
                            {{ trans('cruds.link.fields.tags') }}
                        </th>
                        <th>
                            {{ trans('cruds.link.fields.affect_node') }}
                        </th>
                        <th>
                            {{ trans('cruds.link.fields.affected_svg_state') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($links as $key => $link)
                        <tr data-entry-id="{{ $link->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $link->id ?? '' }}
                            </td>
                            <td>
                                {{ $link->from_node->text ?? '' }}
                            </td>
                            <td>
                                {{ $link->to_node->text ?? '' }}
                            </td>
                            <td>
                                {{ $link->label ?? '' }}
                            </td>
                            <td>
                                {{ $link->connection_type ?? '' }}
                            </td>
                            <td>
                                {{ $link->weight ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $link->show_text_on_click ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $link->show_text_on_click ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $link->user_created->name ?? '' }}
                            </td>
                            <td>
                                @foreach($link->tags as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $link->affect_node->text ?? '' }}
                            </td>
                            <td>
                                {{ $link->affected_svg_state ?? '' }}
                            </td>
                            <td>
                                @can('link_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.links.show', $link->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('link_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.links.edit', $link->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('link_delete')
                                    <form action="{{ route('admin.links.destroy', $link->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('link_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.links.massDestroy') }}",
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
  let table = $('.datatable-Link:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection