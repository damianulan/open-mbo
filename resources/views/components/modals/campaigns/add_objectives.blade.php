<div class="modal fade" id="containerModal" tabindex="-1" aria-labelledby="containerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-3" id="containerModalLabel">{{ $form->title() }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                {{ $form->render() }}
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
</div>
<script type="text/javascript">

$(document).ready(function() {
    $.rebuildVendors();
});

$('select[name="template_id"]').on('change', function() {
    $.jsonAjax('{{ route('ajax.get_model_instance') }}', {
        model: 'objective_template',
        id: $(this).val()
    }, function(response) {
        var instance = response.instance;
        if(instance){
            $('input[name="name"]').val(instance.name);
            var descr_trix = document.querySelector("trix-editor");
            console.log(descr_trix.editor, instance.description);
            $('input[name="goal"]').val(instance.goal);
            $('input[name="award"]').val(instance.award);

            // descr_trix.editor.setSelectedRange([0, 0]);
            // descr_trix.editor.insertHTML(instance.description);

        }
    },
    function(response) {
        $.error('Wystąpił błąd podczas pobierania danych z bazy danych. Zweryfikuj swoje połączenie internetowe.');
    }
    );
});
</script>
