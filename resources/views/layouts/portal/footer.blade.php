<script src="{{asset('themes/vendors/jquery.min.js')}}"></script>
<script type="text/javascript">
/*global variables*/
var SITEURL = '{{ config('app.url') }}';
/*
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
} */
var csrf = $('meta[name="csrf-token"]').attr('content');
</script>
<script src="{{ asset('scripts/globals.js') }}"
<script src="{{asset('themes/vendors/datatables/datatables.min.js')}}"></script>
<script src="{{asset('themes/vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('themes/'.$theme.'/app.js')}}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
@yield('page-scripts')
</div>
<footer></footer>
</body>
</html>