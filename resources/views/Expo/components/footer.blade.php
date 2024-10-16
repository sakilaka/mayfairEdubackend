<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

<script src="{{ asset('backend/assets/vendors/js/vendor.bundle.base.js') }}"></script>

<script>
    $('[data-toggle="tooltip"]').tooltip();
</script>

<style>
    .fixed-buttons {
        position: fixed;
        bottom: 50%;
        right: 0;
        transform: translateY(50%);
        z-index: 999;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        border-radius: 0 0 0 10px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .fixed-buttons.hidden {
        transform: translateX(100%);
    }

    .fixed-buttons .btn {
        width: 105px;
        font-size: 12px;
        font-weight: bold;
        box-shadow: 0 4px 15px -5px rgba(50, 50, 50, 0.25);
        border-radius: 0;
    }

    #btn-toggle {
        position: fixed;
        bottom: 50%;
        right: 115px;
        transform: translateY(50%);
        z-index: 1000;
        background-color: transparent;
        border: none;
        cursor: pointer;
        font-size: 24px;
        color: var(--primary_background);
        transition: right 0.3s ease;
    }
</style>

{{-- <button id="btn-toggle">
        <i class="fa fa-arrow-left"></i>
    </button> --}}

<div class="fixed-buttons" id="fixed-buttons">
    <a class="nav-link registration-btn rounded-0 btn-primary-bg px-2"
        href="http://studyinchinaexhibition.com/expo-sign-up" style="color: white;">Participate</a>
</div>
<script>
    document.getElementById('btn-toggle').addEventListener('click', function() {
        const fixedButtons = document.getElementById('fixed-buttons');
        const toggleButton = document.getElementById('btn-toggle');

        fixedButtons.classList.toggle('hidden');

        if (fixedButtons.classList.contains('hidden')) {
            toggleButton.style.right = '5px';
        } else {
            toggleButton.style.right = '115px';
        }
    });
</script>
