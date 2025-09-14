<script type="text/javascript" id="global_variables">
    const SITEURL = '{{ url('/') }}';
    const csrf = $('meta[name="csrf-token"]').attr('content');

    const globalLocale = '{{ config('app.locale') }}';

    const getModalUrl = '{{ route("general.get_modal") }}';

    const alert_ajax_error = '{{ __('alerts.error.ajax') }}';
    const alert_success = '{{ __('alerts.success.operation') }}';
    const alert_warning = '{{ __('alerts.warning.operation') }}';
    const alert_error = '{{ __('alerts.error.operation') }}';

    const choose = '{{ __('forms.placeholders.choose') }}';
    const no_results = '{{ __('globals.search_no_results') }}';

    const datetime_format = '{{ config('app.datetime_format') }}';
    const time_format = '{{ config('app.time_format') }}';
    const date_format = '{{ config('app.date_format') }}';
</script>
