<div class="row">
    <div class="col-md-12">
        <div class="d-flex">
            <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#columnsModal_{{ $datatable_id }}" data-tippy-content="{{ __('facades.datatables.select_columns') }}">
                <i class="bi bi-list-check"></i>
            </button>
        </div>
    </div>
</div>
<div class="modal fade" id="columnsModal_{{ $datatable_id }}" tabindex="-1" aria-labelledby="columnsModal_{{ $datatable_id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <form method="POST" action="{{ route('datatables.save_columns') }}" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <input type="hidden" name="datatable_id" value="{{ $datatable_id }}"/>
            <div class="modal-header">
            <h1 class="modal-title fs-3" id="columnsModal_{{ $datatable_id }}Label">{{ __('facades.datatables.select_columns') }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('buttons.close') }}"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($columns as $key => $column)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input columns-check" type="checkbox" name="columns[]" value="{{ $key }}" id="{{ $key }}_check"{{ in_array($key, $selected) ? ' checked':'' }}>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $column->title }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" id="columnsModalDismiss" data-bs-dismiss="modal">{{ __('buttons.close') }}</button>
                <button type="submit" class="btn btn-primary">{{ __('buttons.save') }}</button>
            </div>
        </form>
      </div>
    </div>
</div>
