<script type="text/javascript">
    var SITEURL = '{{ url('/') }}';
    var csrf = $('meta[name="csrf-token"]').attr('content');

    var choose = '{{ __('vocabulary.select_choose') }}';
    var no_results = '{{ __('vocabulary.search_no_results') }}';

    var date_format = 'dd-mm-YYYY';
    var time_fomrat = 'H:i';
    var datetime_format = date_format + ' ' + time_fomrat;
</script>