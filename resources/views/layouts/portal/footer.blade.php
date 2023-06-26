<script src="{{asset('themes/vendors/jquery.min.js')}}"></script>
@include('layouts.portal.scripts')
<script src="{{ asset('scripts/globals.js') }}"></script>
<script src="{{asset('themes/vendors/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script src="{{asset('themes/'.$page->theme.'/app.js')}}"></script>

@yield('page-scripts')
</div>
<footer></footer>
</body>
</html>
