<div class="modal fade" id="containerModal" tabindex="-1" aria-labelledby="containerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content modal-form-content">
        <div class="modal-header">
          <h1 class="modal-title fs-3" id="containerModalLabel">{{ $form->title() }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('buttons.close') }}"></button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                {{ $form->render() }}
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">{{ __('buttons.close') }}</button>
          <button type="button" class="btn btn-primary" id="modal_save">{{ __('buttons.save') }}</button>
        </div>
      </div>
    </div>
</div>
<script type="text/javascript">

$(document).ready(function() {
    $.rebuildVendors();
});

$('#modal_save').on('click', function() {
    @if (isset($id))
        $.ajaxForm('{{ route('mbo.objectives.assignment.update_evaluation', $id) }}', 'user_objective_edit_realization', function(response) {
            $.success(response.message, null, function() {
                window.location.reload();
            });
        },
        function(response) {
            $.error(response.message);
        });
    @endif

});

</script>
