<script src="{{asset('themes/vendors/jquery.min.js')}}"></script>
<script type="text/javascript">
    var SITEURL = '{{ url('/') }}';
    var csrf = $('meta[name="csrf-token"]').attr('content');
    var choose = '{{ __('Wybierz...') }}';
</script>
<script src="{{ asset('scripts/globals.js') }}"></script>
<script src="{{asset('themes/vendors/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script src="{{asset('themes/'.$page->theme.'/app.js')}}"></script>

@yield('page-scripts')
</div>
<footer></footer>
</body>
</html>