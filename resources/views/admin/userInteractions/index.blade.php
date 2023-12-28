@extends('layouts.admin')
@section('content')
@can('user_interaction_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.user-interactions.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.userInteraction.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.userInteraction.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-UserInteraction">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.userInteraction.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.userInteraction.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.userInteraction.fields.node_or_link_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.userInteraction.fields.type') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userInteractions as $key => $userInteraction)
                        <tr data-entry-id="{{ $userInteraction->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $userInteraction->id ?? '' }}
                            </td>
                            <td>
                                {{ $userInteraction->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $userInteraction->node_or_link_number ?? '' }}
                            </td>
                            <td>
                                {{ $userInteraction->type ?? '' }}
                            </td>
                            <td>
                                @can('user_interaction_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.user-interactions.show', $userInteraction->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('user_interaction_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.user-interactions.edit', $userInteraction->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('user_interaction_delete')
                                    <form action="{{ route('admin.user-interactions.destroy', $userInteraction->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('user_interaction_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.user-interactions.massDestroy') }}",
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
  let table = $('.datatable-UserInteraction:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection