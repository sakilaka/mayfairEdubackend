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
                                                    class="form-control form-control-lg">
                                                    <option value="">Select Section</option>
                                                    <option value="quick_links">Quick Links</option>
                                                    <option value="explore">Explore</option>
                                                    <option value="policies">Policies</option>
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
                                                    class="form-control form-control-lg">
                                                    <option value="">Select Page</option>
                                                    @foreach ($pages as $page)
                                                        <option value="{{ $page['title'] }}|{{ $page['slug'] }}">
                                                            {{ $page['title'] }}
                                                        </option>
                                                    @endforeach

                                                    <option value="Our Services|{{ route('frontend.our_services') }}">
                                                        Our Services
                                                    </option>
                                                    <option value="Authorization Letters|{{ route('frontend.authorization_letters') }}">
                                                        Authorization Letters
                                                    </option>
                                                    <option value="Payment Process|{{ route('frontend.payment_process') }}">
                                                        Payment Process
                                                    </option>
                                                    <option value="Why China|{{ route('frontend.why_china') }}">
                                                        Why China
                                                    </option>
                                                    <option value="About MalishaEdu|{{ route('frontend.company_details') }}">
                                                        About MalishaEdu
                                                    </option>
                                                    <option value="Become A Partner|{{ route('frontend.instructor') }}">
                                                        Become A Partner
                                                    </option>
                                                    <option value="FAQ|{{ route('frontend.faq') }}">
                                                        FAQ
                                                    </option>
                                                    <option value="Terms & Conditions|{{ route('frontend.terms_conditions') }}">
                                                        Terms & Conditions
                                                    </option>
                                                    <option value="Refund Policy|{{ route('frontend.refund_policy') }}">
                                                        Refund Policy
                                                    </option>
                                                    <option value="Privacy Policy|{{ route('frontend.privacy_policy') }}">
                                                        Privacy Policy
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
