</div>
<input type="hidden" id="modal-input" data-bs-toggle="modal" data-bs-target="#containerModal" />
<div id="modal-container"></div>
<script src="{{ asset('themes/vendors/datatables/datatables.min.js') }}"></script>
@formForgeScripts
@livewireScripts
<script src="{{ asset('themes/js/app.js') }}"></script>
@include('layouts.components.alerts');
@stack('scripts')
@stack('custom-scripts')

<footer></footer>
</body>
</html>
