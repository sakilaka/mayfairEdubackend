<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="_token" content="{{ csrf_token() }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/images/favicon.png') }}" />

<link rel="stylesheet" href="{{ asset('backend/assets/vendors/iconfonts/font-awesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/css/vendor.bundle.base.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/css/vendor.bundle.addons.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
<link rel="stylesheet"
    href="{{ asset('backend/assets/vendors/iconfonts/simple-line-icon/css/simple-line-icons.css') }}">

<style>
    :root {
        --primary_background: #e74c3c;
        --secondary_background: #c34031;
        --tertiary_background: #c0392b;

        --btn_primary_color: var(--secondary_background);
        --btn_primary_hover_color: var(--primary_background);

        --btn_secondary_color: var(--primary_background);
        --btn_secondary_hover_color: var(--secondary_background);

        --btn_tertiary_color: var(--tertiary_background);
        --btn_tertiary_hover_color: {{ '#c10000' }};

        --section_background: {{ '#f2fafe' }};
    }

    /* assign btn theme for this site */
    .btn-primary-light-bg {
        background-color: var(--btn_primary_color) !important;
        color: white !important;
    }

    .btn-primary-bg {
        background-color: var(--btn_primary_color) !important;
        color: white !important;
        font-family: 'DM Sans', sans-serif !important;
    }

    .btn-primary-bg:hover {
        background-color: var(--btn_primary_hover_color) !important;
    }

    .btn-secondary-bg {
        background-color: var(--btn_secondary_color) !important;
        color: white !important;
        font-family: 'DM Sans', sans-serif !important;
    }

    .btn-secondary-bg:hover {
        background-color: var(--btn_secondary_hover_color) !important;
    }

    .btn-tertiary-bg {
        background-color: var(--btn_tertiary_color) !important;
        color: white !important;
        font-family: 'DM Sans', sans-serif !important;
    }

    .btn-tertiary-bg:hover {
        background-color: var(--btn_tertiary_hover_color) !important;
    }
</style>

<link rel="stylesheet" href="{{ asset('backend/assets/css/dataTable-buttons.min.css') }}">
<style>
    @media screen and (max-width:640px) {
        .dt-buttons {
            margin-bottom: 1rem;
        }
    }

    .navbar {
        background-image: url('{{ asset('frontend/expo-domain/images/rectangle_1.png') }}');
    }

    .navbar.default-layout-navbar .navbar-brand-wrapper,
    .navbar.default-layout-navbar .navbar-menu-wrapper {
        background-color: transparent;
        border-radius: 0;
    }

    .navbar.default-layout-navbar .navbar-menu-wrapper .navbar-nav .nav-item .nav-link {
        color: white;
        font-weight: 600;
    }

    .navbar.default-layout-navbar .navbar-menu-wrapper .navbar-toggler span {
        color: #fff !important;
    }

    .card-red-pattern-bg {
        position: relative;
        overflow: hidden;
        border-bottom-left-radius: 25px;
        border-bottom-right-radius: 25px;
    }

    .card-red-pattern-bg::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(255, 255, 255, 0.313), rgba(255, 255, 255, 0.371)),
            url('{{ asset('frontend/images/logo/bottom-objects.png') }}');
        background-position: bottom;
        background-repeat: no-repeat;
        background-size: cover;
        z-index: 1;
        opacity: 0.5;
    }

    .card-red-pattern-bg .card-title, .card-red-pattern-bg .card-body {
        position: relative;
        z-index: 2;
    }
</style>
