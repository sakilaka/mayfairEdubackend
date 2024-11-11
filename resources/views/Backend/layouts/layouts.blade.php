@php
   $prefix= Request::route()->getPrefix();
   $route=Route::current()->getname();
@endphp

<!DOCTYPE html>
<html lang="en">
  <head>

   @php
    $logo = \App\Models\Tp_option::where('option_name', 'theme_logo')->first();
   @endphp
    <link rel="shortcut icon" href="{{@$logo->favicon_show}}" type="image/x-icon">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Bracket Plus">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/bracketplus/img/bracketplus-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/bracketplus">
    <meta property="og:title" content="Bracket Plus">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/bracketplus/img/bracketplus-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/bracketplus/img/bracketplus-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>@yield('title', 'Admin Dashboard')</title>
    @php
        $results = \App\Models\Tp_option::where('option_name', 'theme_color')->first();
        $dataObj = json_decode($results->option_value);
   @endphp
    @if($dataObj)
    <style>
        :root {
            --theme_color: {{ $dataObj->theme_color }};
            --theme_text_color: {{ $dataObj->theme_text_color }};
            --theme_hover_color: {{ $dataObj->theme_hover_color }};
        }
        table.dataTable.dtr-inline.collapsed > tbody > tr[role="row"] > td:first-child::before {
            background-color: var(--theme_color)!important;
        }
    </style>
    @endif

    <!--- ######    All Css Links    #######  --->
    @include('Backend.layouts.layout_parts.css')
     @yield('style')
        <!-- Scripts -->

  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    @include('Backend.layouts.layout_parts.left-panel')
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    @include('Backend.layouts.layout_parts.header')
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    @include('Backend.layouts.layout_parts.right-panel')
    <!-- ########## END: RIGHT PANEL ########## --->

    <!-- ########## START: MAIN PANEL ########## -->
    @yield('main_contain')
    <!-- ########## END: MAIN PANEL ########## -->

    <!--- ######### All Scripts ###########--->
    @include('Backend.layouts.layout_parts.scripts')

    @yield('script')
    <!--- ######### All Scripts ###########--->
  </body>
</html>
