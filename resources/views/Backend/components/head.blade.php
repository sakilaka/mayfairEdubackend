<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="_token" content="{{ csrf_token() }}">
<link rel="shortcut icon" type="image/png" href="{{ asset('backend/assets/images/fav.png') }}" />

<link rel="stylesheet" href="{{ asset('backend/assets/vendors/iconfonts/font-awesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/css/vendor.bundle.base.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/css/vendor.bundle.addons.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
<link rel="stylesheet"
    href="{{ asset('backend/assets/vendors/iconfonts/simple-line-icon/css/simple-line-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


@php
    $results = \App\Models\Tp_option::where('option_name', 'theme_color')->first();
    $dataObj = json_decode($results->option_value);
@endphp
@if ($dataObj)
    <style>
        :root {
            --primary_background: {{ $theme_color['primary_color'] ?? '#068b76' }};
            --secondary_background: {{ $theme_color['secondary_color'] ?? '#1e565c' }};
            --tertiary_background: {{ $theme_color['tertiary_color'] ?? '#f40000' }};

            --btn_primary_color: var(--secondary_background);
            --btn_primary_hover_color: var(--primary_background);

            --btn_secondary_color: var(--primary_background);
            --btn_secondary_hover_color: var(--secondary_background);

            --btn_tertiary_color: var(--tertiary_background);
            --btn_tertiary_hover_color: {{ '#c10000' }};

            --section_background: {{ '#f2fafe' }};
        }

        /* assign btn theme for this site */
        .btn-primary-bg {
            background-color: var(--btn_primary_color) !important;
            color: white !important;
        }

        .btn-primary-bg:hover {
            background-color: var(--btn_primary_hover_color) !important;
        }

        .btn-secondary-bg {
            background-color: var(--btn_secondary_color) !important;
            color: white !important;
        }

        .btn-secondary-bg:hover {
            background-color: var(--btn_secondary_hover_color) !important;
        }

        .btn-tertiary-bg {
            background-color: var(--btn_tertiary_color) !important;
            color: white !important;
        }

        .btn-tertiary-bg:hover {
            background-color: var(--btn_tertiary_hover_color) !important;
        }
    </style>
@endif

<link rel="stylesheet" href="{{ asset('backend/assets/css/dataTable-buttons.min.css') }}">
<style>
    @media screen and (max-width:640px) {
        .dt-buttons {
            margin-bottom: 1rem;
        }
    }
</style>
