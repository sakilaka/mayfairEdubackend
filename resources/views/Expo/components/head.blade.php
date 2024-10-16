<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300italic,regular,italic,700,700italic&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin,latin-ext,vietnamese">
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin,latin-ext,vietnamese">
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&amp;subset=latin,latin-ext,vietnamese">
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Barlow+Condensed:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&amp;subset=latin,latin-ext,vietnamese">

<style>
    :root {
        --primary_background: #0c4493;
        --secondary_background: #58b135;
        --tertiary_background: #c0392b;

        --btn_primary_color: var(--secondary_background);
        --btn_primary_hover_color: var(--primary_background);

        --btn_secondary_color: var(--primary_background);
        --btn_secondary_hover_color: var(--secondary_background);

        --btn_tertiary_color: var(--tertiary_background);
        --btn_tertiary_hover_color: {{ '#c10000' }};
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

@if (Route::is('home'))
    <link rel="stylesheet" href="{{ asset('frontend/expo-domain/css/bootstrap.min.css') }}" crossorigin="anonymous">
@else
    @include('Expo.layouts.parts.header-link')
@endif
<link rel="stylesheet" href="{{ asset('frontend/expo-domain/css/site.css') }}?v={{ rand() }}">

<style>
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
        background: linear-gradient(rgba(255, 255, 255, 0.363), rgba(255, 255, 255, 0.378)),
            url('{{ asset('frontend/images/logo/bottom-objects.png') }}');
        background-position: bottom;
        background-repeat: no-repeat;
        background-size: cover;
        z-index: 1;
        opacity: 1;
    }

    .card-red-pattern-bg div {
        position: relative;
        z-index: 2;
    }
</style>

<style>
    .dropdown-item:focus,
    .dropdown-item:hover {
        color: white;
        background-color: var(--primary_background);
    }

    .dropdown-menu {
        --bs-dropdown-zindex: 9000;
    }
</style>
