<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/summernote/dist/summernote-bs4.css') }}">
    <title>{{ env('APP_NAME') }} | Edit review</title>
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
                            Edit review
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.review.index') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All review</a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-md-9 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample" action="{{ route('admin.review.update', $review->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="" class=" col-form-label">Type</label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input id="" type="text" class="form-control"
                                                    value="{{ ucfirst($review->type) }}" readonly>
                                            </div>
                                        </div>

                                        @if ($review->type == 'Program')
                                            <div class="form-group row">
                                                <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                    <label for="" class=" col-form-label">Program
                                                        Name</label>
                                                    <p>:</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input id="" class="form-control"
                                                        value="{{ @$review->course->name ?? '' }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                    <label for="" class=" col-form-label">University
                                                        Name</label>
                                                    <p>:</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input id="" class="form-control"
                                                        value="{{ @$review->course->university->name ?? '' }}" readonly>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($review->type == 'university')
                                            <div class="form-group row">
                                                <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                    <label for="" class=" col-form-label">University
                                                        Name</label>
                                                    <p>:</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input id="" class="form-control"
                                                        value="{{ @$review->university->name ?? '' }}" readonly>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="category_name" class=" col-form-label">Reviewer Name</label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input id="category_name" type="text" class="form-control"
                                                    value="{{ $review->user->name ?? '' }}" readonly>
                                                <input value="{{ $review->user->id ?? '' }}" type="hidden"
                                                    name="user_id">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="category_name" class=" col-form-label">Reviewer Mobile
                                                    Number</label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input id="category_name" type="text" class="form-control"
                                                    value="{{ $review->user->mobile ?? '' }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="category_name" class=" col-form-label">Reviewer
                                                    Email</label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input id="category_name" type="text" class="form-control"
                                                    value="{{ $review->user->email ?? '' }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="category" class=" col-form-label">Star</label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <select class="form-control form-control-lg" name="ratting"
                                                    id="category" required>
                                                    <option value="">Select Star</option>
                                                    <option @if ($review->ratting == 1) Selected @endif
                                                        value="1">1 Star</option>
                                                    <option @if ($review->ratting == 2) Selected @endif
                                                        value="2">2 Star</option>
                                                    <option @if ($review->ratting == 3) Selected @endif
                                                        value="3">3 Star</option>
                                                    <option @if ($review->ratting == 4) Selected @endif
                                                        value="4">4 Star</option>
                                                    <option @if ($review->ratting == 5) Selected @endif
                                                        value="5">5 Star</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="menu_position" class=" col-form-label">Description</label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <textarea id="summernote" name="comment" style="height: 150px" required>{{ $review->comment }}</textarea>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary mr-2">Update</button>
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

    <script src="{{ asset('backend/lib/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $('#summernote').summernote({
            placeholder: 'Write something...',
            tabsize: 4,
            height: 150
        });
    </script>
</body>

</html>
