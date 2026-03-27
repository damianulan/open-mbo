{!! $form->render() !!}

@push('custom-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var datatable_id = '{{ $id }}';
            var table = $('#' + datatable_id).DataTable();
            var filter_form_id = '{{ $form->getId() }}'


            $('#' + filter_form_id).on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = {};
                form.serializeArray().forEach(function(field) {
                    formData[field.name] = field.value;
                });

                table.on('preXhr.dt', function (e, settings, data) {
                    data.filters = formData;
                });

                table.ajax.reload();
                $.hideOverlay();
            });

        });

    </script>
@endpush
