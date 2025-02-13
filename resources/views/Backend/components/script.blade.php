<script src="{{ asset('backend/assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/js/vendor.bundle.addons.js') }}"></script>
<script src="{{ asset('backend/assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('backend/assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('backend/assets/js/misc.js') }}"></script>
<script src="{{ asset('backend/assets/js/settings.js') }}"></script>
<script src="{{ asset('backend/assets/js/todolist.js') }}"></script>
<script src="{{ asset('backend/assets/js/dashboard.js') }}"></script>
<script src="{{ asset('backend/assets/js/toastDemo.js') }}"></script>
<script src="{{ asset('backend/assets/js/tooltips.js') }}"></script>
<script src="{{ asset('backend/assets/js/popover.js') }}"></script>

<script src="{{ asset('backend/assets/js/data-table.js') }}"></script>
<script src="{{ asset('backend/assets/js/dataTable-buttons.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/dataTable-jsZip.js') }}"></script>
<script src="{{ asset('backend/assets/js/dataTable-pdfMake.js') }}"></script>
<script src="{{ asset('backend/assets/js/dataTable-vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/assets/js/dataTable-button_html5.js') }}"></script>
<script src="{{ asset('backend/assets/js/dataTable-button_print.js') }}"></script>


{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>


@include('Backend.components.message')

<script>
    $('.delete-item').click(function() {
        var item_id = $(this).prev('input[type="hidden"]').val();
        $('#modal_item_id').val(item_id);
    });
</script>
