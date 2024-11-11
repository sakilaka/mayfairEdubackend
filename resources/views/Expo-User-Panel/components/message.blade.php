{{-- ============================= Toast Message (Start) ============================= --}}
@if (session('success'))
    <script>
        setTimeout(function() {
            showSuccessToast('{{ session('success') }}');
        }, 500);
    </script>
@endif

@if (session('error'))
    <script>
        setTimeout(function() {
            showDangerToast('{{ session('error') }}');
        }, 500);
    </script>
@endif
{{-- ============================= Toast Message (End) ============================= --}}
