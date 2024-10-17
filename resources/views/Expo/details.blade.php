<!DOCTYPE html>
<html lang="en">

<head>
    @include('Expo.components.head')
    <title>{{ env('APP_NAME') }} - Details of {{ $expo['title'] }}</title>

    <link rel="stylesheet" href="{{ asset('frontend/ckeditor5-rendered.css') }}">
</head>

<body>
    @php
        $additional_contents = json_decode($expo->additional_contents, true) ?? [];
        $place = json_decode($expo->place, true) ?? [];
        $datetime = json_decode($expo->datetime, true) ?? [];
    @endphp

    @include('Expo.home_sections.hero')

    @include('Expo.home_sections.section_2')

    @include('Expo.home_sections.organizer_profile')

    @include('Expo.home_sections.co_organizer_profile')

    @include('Expo.home_sections.footer')

    @include('Expo.components.footer')
</body>

</html>
