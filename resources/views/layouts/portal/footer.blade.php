<script src="{{asset('themes/vendors/jquery.min.js')}}"></script>
<script type="text/javascript">
    var SITEURL = '{{ $page->sitename }}';
    var csrf = $('meta[name="csrf-token"]').attr('content');
</script>
<script src="{{ asset('scripts/globals.js') }}"
<script src="{{asset('themes/vendors/datatables/datatables.min.js')}}"></script>
<script src="{{asset('themes/'.$page->theme.'/app.js')}}"></script>
<!--<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>-->
@yield('page-scripts')
</div>
<footer></footer>
</body>
</html>