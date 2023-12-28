@extends('layouts.admin')
@section('content')
@can('node_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.nodes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.node.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.node.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Node">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.node.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.node.fields.text') }}
                        </th>
                        <th>
                            {{ trans('cruds.node.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.node.fields.weight') }}
                        </th>
                        <th>
                            {{ trans('cruds.node.fields.show_text_on_click') }}
                        </th>
                        <th>
                            {{ trans('cruds.node.fields.object_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.node.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.node.fields.tags') }}
                        </th>
                        <th>
                            {{ trans('cruds.node.fields.default_node_image') }}
                        </th>
                        <th>
                            {{ trans('cruds.node.fields.other_node_images') }}
                        </th>
                        <th>
                            {{ trans('cruds.node.fields.location') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($content_tags as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nodes as $key => $node)
                        <tr data-entry-id="{{ $node->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $node->id ?? '' }}
                            </td>
                            <td>
                                {{ $node->text ?? '' }}
                            </td>
                            <td>
                                {{ $node->gender ?? '' }}
                            </td>
                            <td>
                                {{ $node->weight ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $node->show_text_on_click ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $node->show_text_on_click ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $node->object_type ?? '' }}
                            </td>
                            <td>
                                {{ $node->user->name ?? '' }}
                            </td>
                            <td>
                                @foreach($node->tags as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if($node->default_node_image)
                                    <a href="{{ $node->default_node_image->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                @foreach($node->other_node_images as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $node->location ?? '' }}
                            </td>
                            <td>
                                @can('node_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.nodes.show', $node->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('node_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.nodes.edit', $node->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('node_delete')
                                    <form action="{{ route('admin.nodes.destroy', $node->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('node_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.nodes.massDestroy') }}",
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
  let table = $('.datatable-Node:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection