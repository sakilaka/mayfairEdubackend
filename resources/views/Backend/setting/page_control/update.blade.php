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
                                                <label for="title" class=" col-form-label">Page
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <select name="page" id="page"
                                                    class="form-control form-control-lg" required>
                                                    <option value="">Select Page</option>
                                                    @foreach ($pages as $page)
                                                        <option value="{{ $page['title'] }}|{{ $page['slug'] }}"
                                                            @if ($page_control['page'] . '|' . $page_control['url'] == $page['title'] . '|' . $page['slug']) selected @endif>
                                                            {{ $page['title'] }}
                                                        </option>
                                                    @endforeach

                                                    <option
                                                        value="Our Services|{{ ltrim(Str::replaceFirst(url('/'), '', route('frontend.our_services')), '/') }}"
                                                        @if (
                                                            $page_control['page'] . '|' . $page_control['url'] ==
                                                                'Our Services' . '|' . ltrim(Str::replaceFirst(url('/'), '', route('frontend.our_services')), '/')) selected @endif>
                                                        Our Services
                                                    </option>
                                                    <option
                                                        value="Authorization Letters|{{ ltrim(Str::replaceFirst(url('/'), '', route('frontend.authorization_letters')), '/') }}">
                                                        Authorization Letters
                                                    </option>
                                                    <option
                                                        value="Why China|{{ ltrim(Str::replaceFirst(url('/'), '', route('frontend.why_china')), '/') }}">
                                                        Why China
                                                    </option>
                                                    <option
                                                        value="About MalishaEdu|{{ ltrim(Str::replaceFirst(url('/'), '', route('frontend.company_details')), '/') }}">
                                                        About MalishaEdu
                                                    </option>
                                                    <option
                                                        value="Become A Partner|{{ ltrim(Str::replaceFirst(url('/'), '', route('frontend.instructor')), '/') }}">
                                                        Become A Partner
                                                    </option>
                                                    <option
                                                        value="FAQ|{{ ltrim(Str::replaceFirst(url('/'), '', route('frontend.faq')), '/') }}">
                                                        FAQ
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

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
