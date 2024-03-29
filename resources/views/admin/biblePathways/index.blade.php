@extends('layouts.admin')
@section('content')
@can('bible_pathway_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.bible-pathways.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.biblePathway.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.biblePathway.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-BiblePathway">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.biblePathway.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.biblePathway.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.biblePathway.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.biblePathway.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.biblePathway.fields.tags') }}
                        </th>
                        <th>
                            {{ trans('cruds.biblePathway.fields.categories') }}
                        </th>
                        <th>
                            {{ trans('cruds.biblePathway.fields.links') }}
                        </th>
                        <th>
                            {{ trans('cruds.biblePathway.fields.diagram_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.diagramType.fields.specialty_field') }}
                        </th>
                        <th>
                            {{ trans('cruds.biblePathway.fields.root_node') }}
                        </th>
                        <th>
                            {{ trans('cruds.biblePathway.fields.double_tree_left_node') }}
                        </th>
                        <th>
                            {{ trans('cruds.biblePathway.fields.double_tree_right_node') }}
                        </th>
                        <th>
                            {{ trans('cruds.biblePathway.fields.sankey_start_node') }}
                        </th>
                        <th>
                            {{ trans('cruds.biblePathway.fields.sankey_end_node') }}
                        </th>
                        <th>
                            {{ trans('cruds.biblePathway.fields.link_for_pathway') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($biblePathways as $key => $biblePathway)
                        <tr data-entry-id="{{ $biblePathway->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $biblePathway->id ?? '' }}
                            </td>
                            <td>
                                {{ $biblePathway->title ?? '' }}
                            </td>
                            <td>
                                {{ $biblePathway->description ?? '' }}
                            </td>
                            <td>
                                {{ $biblePathway->user->name ?? '' }}
                            </td>
                            <td>
                                @foreach($biblePathway->tags as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($biblePathway->categories as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($biblePathway->links as $key => $item)
                                    <span class="badge badge-info">{{ $item->label }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $biblePathway->diagram_type->name ?? '' }}
                            </td>
                            <td>
                                {{ $biblePathway->diagram_type->specialty_field ?? '' }}
                            </td>
                            <td>
                                {{ $biblePathway->root_node->text ?? '' }}
                            </td>
                            <td>
                                {{ $biblePathway->double_tree_left_node->text ?? '' }}
                            </td>
                            <td>
                                {{ $biblePathway->double_tree_right_node->text ?? '' }}
                            </td>
                            <td>
                                {{ $biblePathway->sankey_start_node->text ?? '' }}
                            </td>
                            <td>
                                {{ $biblePathway->sankey_end_node->text ?? '' }}
                            </td>
                            <td>
                                {{ $biblePathway->link_for_pathway ?? '' }}
                            </td>
                            <td>
                                @can('bible_pathway_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.bible-pathways.show', $biblePathway->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('bible_pathway_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.bible-pathways.edit', $biblePathway->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('bible_pathway_delete')
                                    <form action="{{ route('admin.bible-pathways.destroy', $biblePathway->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('bible_pathway_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bible-pathways.massDestroy') }}",
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
  let table = $('.datatable-BiblePathway:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection