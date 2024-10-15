<!DOCTYPE html>
<html lang="en">

<head>
    @include('Frontend.components.head')
    <title>{{ env('APP_NAME') }} - Expo</title>
</head>

<body>
    @include('Frontend.home_sections.hero')

    @include('Frontend.home_sections.section_2')

    <section class="overlay-section">
        <div class="overlay"></div>
    </section>

    @include('Frontend.home_sections.exhibitors')

    @include('Frontend.home_sections.organizer_profile')

    @include('Frontend.home_sections.co_organizer_profile')

    @include('Frontend.home_sections.footer')

    @include('Frontend.components.footer')
</body>

</html>
