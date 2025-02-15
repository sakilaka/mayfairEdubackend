<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Assign Page</title>
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
                            Assign Page
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
                                    <form class="forms-sample" action="{{ route('admin.page_control.store') }}"
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
                                                    <option value="quick_links">Quick Links</option>
                                                    <option value="explore">Explore</option>
                                                    <option value="policies">Policies</option>
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
                                                <input type="text" name="page" placeholder="Enter Page Title" class="form-control form-control-lg">
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
                                                <input type="text" name="url" placeholder="Enter Page URL" class="form-control form-control-lg">
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
                                                <select name="page" id="page"
                                                    class="form-control form-control-lg" required>
                                                    <option value="">Select Page</option>
                                                    @foreach ($pages as $page)
                                                        <option value="{{ $page['title'] }}|{{ $page['slug'] }}">
                                                            {{ $page['title'] }}
                                                        </option>
                                                    @endforeach

                                                    <option
                                                        value="Our Services|{{ ltrim(Str::replaceFirst(url('/'), '', route('frontend.our_services')), '/') }}">
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
