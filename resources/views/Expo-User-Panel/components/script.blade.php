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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

@include('User-Backend.components.message')

<script>
    $('.delete-item').click(function() {
        var item_id = $(this).prev('input[type="hidden"]').val();
        $('#modal_item_id').val(item_id);
    });
</script>
