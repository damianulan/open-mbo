</div>
<input type="hidden" id="modal-input" data-bs-toggle="modal" data-bs-target="#containerModal" />
<div id="modal-container"></div>
<script type="text/javascript" id="global_variables">
    var globalLocale = '{{ config('app.locale') }}';

    var getModalUrl = '{{ route("general.get_modal") }}';

</script>
<script src="{{ asset('scripts/globals.js') }}"></script>
<script src="{{ asset('themes/vendors/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('themes/'.$page->theme.'/app.js') }}"></script>
@include('layouts.components.alerts');
@yield('page-scripts')
<footer></footer>
</body>
</html>
