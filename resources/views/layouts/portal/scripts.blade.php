<script type="text/javascript" id="global_variables">
    var SITEURL = '{{ url('/') }}';
    var csrf = $('meta[name="csrf-token"]').attr('content');

    var choose = '{{ __('vocabulary.select_choose') }}';
    var no_results = '{{ __('vocabulary.search_no_results') }}';

    var date_format = '{{ config('app.date_format') }}';
    var time_format = '{{ config('app.time_format') }}';
    var datetime_format = '{{ config('app.datetime_format') }}';

    var globalLocale = '{{ config('app.locale') }}';

    var getModalUrl = '{{ route("general.get_modal") }}';
</script>
