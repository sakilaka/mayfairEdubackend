<!DOCTYPE html>
<html lang="en">

<head>
    @include('Expo.components.head')
    <title>{{ env('APP_NAME') }} - Details of {{ $expo['title'] }}</title>
    <link rel="stylesheet" href="{{ asset('frontend/ckeditor5-rendered.css') }}">

    @php
        $additional_contents = json_decode($expo->additional_contents, true) ?? [];
        $place = json_decode($expo->place, true) ?? [];
        $datetime = json_decode($expo->datetime, true) ?? [];
    @endphp

    @if (isset($additional_contents['hero_bg']) && $additional_contents['hero_bg'])
        <style>
            .bg-section {
                background-image: url('{{ $additional_contents['hero_bg'] }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }
        </style>
    @else
        <style>
            .bg-section {
                background-color: var(--primary_background);
            }
        </style>
    @endif
</head>

<body>

    @include('Expo.home_sections.hero')

    @include('Expo.home_sections.section_2')

    @include('Expo.home_sections.organizer_profile')

    @include('Expo.home_sections.co_organizer_profile')

    @include('Expo.home_sections.exhibitors')

    @include('Expo.home_sections.delegates')

    @include('Expo.home_sections.footer')

    @include('Expo.components.footer')
</body>

</html>
