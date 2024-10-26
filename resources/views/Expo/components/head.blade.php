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

@php
    $results = \App\Models\Tp_option::where('option_name', 'theme_custom_css')->first();
    $custom_html = \App\Models\Tp_option::where('option_name', 'theme_custom_html')->first();
    $custom_js = \App\Models\Tp_option::where('option_name', 'theme_custom_js')->first();
    $theme_seo = \App\Models\Tp_option::where('option_name', 'theme_options_seo')->first();
    $title = \App\Models\Tp_option::where('option_name', 'theme_option_header')->first();
    $logo = \App\Models\Tp_option::where('option_name', 'theme_logo')->first();

    $customCss = json_decode($results->option_value);
    $custom_html = json_decode($custom_html->option_value);
    $custom_js = json_decode($custom_js->option_value);
    $metadata = json_decode($theme_seo->option_value);
@endphp

<link rel="shortcut icon" href="{{ @$logo->favicon_show }}" type="image/x-icon">
@php
    $titles = '';
    $keywords = '';
@endphp
@foreach ($metadata->og_title as $k => $item)
    @php
        if (count($metadata->og_title) - 1 == $k) {
            $titles .= $item;
        } else {
            $titles .= $item . ',';
        }
    @endphp
@endforeach
<meta property="og:title" content="{{ $titles }}" />

@foreach ($metadata->og_keywords as $k => $item)
    @php
        if (count($metadata->og_keywords) - 1 == $k) {
            $keywords .= $item;
        } else {
            $keywords .= $item . ',';
        }
    @endphp
@endforeach
<meta property="keywords" content="{{ $keywords }}" />

{{-- open graph --}}
<meta property="og:site_name" content="{{ $title->company_name }}" />
<meta property="og:description" content="{{ $metadata->og_description }}" />
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:image" content="{{ asset('upload/seo/' . $metadata->og_image) }}" />
<meta property="og:image:width" content="600" />
<meta property="og:image:height" content="315" />

@php
    $theme_colors = json_decode($expo->theme_colors, true);
@endphp
<style>
    :root {
        --primary_background: {{ $theme_colors['primary_color'] ?? '#0c4493' }};
        --primary_background_hover: {{ $theme_colors['primary_hover_color'] ?? '#3a62a0' }};
        --secondary_background: {{ $theme_colors['secondary_color'] ?? '#58b135' }};
        --secondary_background_hover: {{ $theme_colors['secondary_hover_color'] ?? '#357e61' }};

        --btn_primary_color: var(--primary_background);
        --btn_primary_hover_color: var(--primary_background_hover);

        --btn_secondary_color: var(--secondary_background);
        --btn_secondary_hover_color: var(--secondary_background_hover);

        --btn_tertiary_color: var(--tertiary_background);
        --btn_tertiary_hover_color: {{ '#c10000' }};
        --section-background: #f2fafe;
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

    .nav-link:hover,
    .nav-link.active {
        background: var(--primary_background) !important;
    }

    .section-background {
        background-color: var(--section-background) !important;
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
            url('{{ asset('frontend/images/logo/bottom-objects-blue.webp') }}');
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

<link rel="stylesheet"
    href="{{ asset('frontend/application/modules/frontend/views/themes/default/assets/css/slick-theme.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('frontend/application/modules/frontend/views/themes/default/assets/css/slick.css') }}">

<style>
    @media screen and (min-width:1199px) {
        .testimonial-title-border {
            position: relative;
        }
    }

    .testimonial-user-img {
        border-radius: 50% !important;
        object-position: center !important;
        object-fit: cover !important;
        padding: 3px;
        background-color: var(--primary_background);
    }

    @media screen and (max-width:767px) {
        .testimonial-user-img {
            width: 4em !important;
            height: 4em !important;

        }
    }

    @media screen and (max-width:991px) {
        .testimonial-user-img {
            width: 7em !important;
            height: 7em !important;
        }
    }

    @media screen and (min-width:992px) {
        .testimonial-user-img {
            width: 10em !important;
            height: 10em !important;
        }
    }

    .testimonial-cards.slick-slide {
        margin: 0 20px !important;
        text-align: center !important;
    }

    .testimonial-single-card {
        background-color: #f1fff79e;
        border-radius: 10px;
        box-shadow: 0 2px 10px -5px rgba(54, 54, 54, 0.75);
        /* height: 575px; */
        /* overflow: auto; */
        /* position: relative; */
    }

    .testimonial-content {
        position: relative;
        height: 150px;
        overflow-y: auto !important;
    }

    .testimonial-content::-webkit-scrollbar {
        width: 3px;
    }

    .testimonial-content::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .testimonial-content::-webkit-scrollbar-thumb {
        background-color: #ddd;
        border-radius: 10px;
    }

    .testimonial-content .more-text {
        display: none;
        color: #333;
    }

    .see-more-btn-container {
        background-color: #f2f8f19e;
        border-radius: 0 0 10px 10px;
        text-align: center;
        padding: 0.5rem;
    }

    .see-more-btn {
        background-color: transparent;
        border: none;
        color: var(--secondary_background);
        cursor: pointer;
        font-size: 1rem;
        font-family: 'DM Sans', sans-serif;
    }
</style>
