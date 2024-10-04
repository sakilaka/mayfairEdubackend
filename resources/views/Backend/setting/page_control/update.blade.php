<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Update Page</title>
</head>

<body>
    <div class="container-scroller">
        @include('Backend.components.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('Backend.components.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            Update Page
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.page_control.index') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                View All</a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-md-9 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample"
                                        action="{{ route('admin.page_control.update', ['id' => $page_control['id']]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="title" class=" col-form-label">Section
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <select name="section" id="section"
                                                    class="form-control form-control-lg" required>
                                                    <option value="">Select Section</option>
                                                    <option value="quick_links"
                                                        @if ($page_control['section'] == 'quick_links') selected @endif>Quick Links
                                                    </option>
                                                    <option value="explore"
                                                        @if ($page_control['section'] == 'explore') selected @endif>Explore
                                                    </option>
                                                    <option value="policies"
                                                        @if ($page_control['section'] == 'policies') selected @endif>Policies
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="page" class=" col-form-label">Title
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="page" placeholder="Enter Page Title"
                                                    value="{{ $page_control['page'] }}"
                                                    class="form-control form-control-lg">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="title" class=" col-form-label">URL
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="url" placeholder="Enter Page URL"
                                                    value="{{ $page_control['url'] }}"
                                                    class="form-control form-control-lg">
                                            </div>
                                        </div>
                                        {{-- <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="title" class=" col-form-label">Page
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                @php
                                                    function generateRouteUrl($routeName)
                                                    {
                                                        return ltrim(
                                                            Str::replaceFirst(url('/'), '', route($routeName)),
                                                            '/',
                                                        );
                                                    }

                                                    $staticPages = [
                                                        ['title' => 'Our Services', 'route' => 'frontend.our_services'],
                                                        [
                                                            'title' => 'Authorization Letters',
                                                            'route' => 'frontend.authorization_letters',
                                                        ],
                                                        ['title' => 'Why China', 'route' => 'frontend.why_china'],
                                                        [
                                                            'title' => 'About MalishaEdu',
                                                            'route' => 'frontend.company_details',
                                                        ],
                                                        [
                                                            'title' => 'Become A Partner',
                                                            'route' => 'frontend.instructor',
                                                        ],
                                                        ['title' => 'FAQ', 'route' => 'frontend.faq'],
                                                    ];
                                                @endphp

                                                <select name="page" id="page"
                                                    class="form-control form-control-lg" required>
                                                    <option value="">Select Page</option>

                                                    @foreach ($pages as $page)
                                                        <option value="{{ $page['title'] }}|{{ $page['slug'] }}"
                                                            @if ($page_control['page'] . '|' . $page_control['url'] == $page['title'] . '|' . $page['slug']) selected @endif>
                                                            {{ $page['title'] }}
                                                        </option>
                                                    @endforeach

                                                    @foreach ($staticPages as $staticPage)
                                                        @php
                                                            $slug = generateRouteUrl($staticPage['route']);
                                                        @endphp
                                                        <option value="{{ $staticPage['title'] }}|{{ $slug }}"
                                                            @if ($page_control['page'] . '|' . $page_control['url'] == $staticPage['title'] . '|' . $slug) selected @endif>
                                                            {{ $staticPage['title'] }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div> --}}

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('Backend.components.footer')
            </div>
        </div>
    </div>

    @include('Backend.components.script')

</body>

</html>
