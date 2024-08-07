<script src="{{ asset('/public/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('public/libs/tabler/dist/js/tabler.min.js') }}"></script>
<script defer src="{{ asset('public/libs/tabler/dist/litepicker/dist/litepicker.js') }}"></script>
<script src="{{ asset('/public/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/public/libs/datatables/plugins/bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('/public/libs/datatables/plugins/buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/public/libs/datatables/plugins/buttons/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('/public/libs/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
<script src="{{ asset('/public/libs/Parsley.js-2.9.2/parsley.min.js') }}"></script>
<script src="{{ asset('/public/libs/jquery-throttle-debounce/jquery.ba-throttle-debounce.min.js') }}"></script>


@stack('libs-js')

<script type="module" src="{{ asset('public/admin/assets/js/i18n.js') }}"></script>
<script src="{{ asset('public/assets/js/scripts.js') }}"></script>
<script src="{{ asset('public/admin/assets/js/setup.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('/public/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('/public/libs/select2/dist/js/i18n/vi.js') }}"></script>
<script src="https://cdn.gtranslate.net/widgets/latest/flags.js" defer></script>
@stack('custom-js')