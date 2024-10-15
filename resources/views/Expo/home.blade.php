<!DOCTYPE html>
<html lang="en">

<head>
    @include('Expo.components.head')
    <title>{{ env('APP_NAME') }} - Expo</title>
</head>

<body>
    @include('Expo.home_sections.hero')

    @include('Expo.home_sections.section_2')

    <section class="overlay-section">
        <div class="overlay"></div>
    </section>

    @include('Expo.home_sections.exhibitors')

    @include('Expo.home_sections.organizer_profile')

    @include('Expo.home_sections.co_organizer_profile')

    @include('Expo.home_sections.footer')

    @include('Expo.components.footer')
</body>

</html>
