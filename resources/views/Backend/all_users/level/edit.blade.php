<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/summernote/dist/summernote-bs4.css') }}">
    <title>{{ env('APP_NAME') }} | Edit Level</title>
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
                            Edit level
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.level.index') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All level</a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-md-12 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample" action="{{ route('admin.level.update', ['id' => $level->id]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf

                                       

                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Star value <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <select class="form-control form-control-lg" name="star_value"
                                                        required>
                                                        <option value="">Select value</option>
                                                        <option value="0" @if ($level->star_value == '0') Selected @endif>Beginner</option>
                                                        <option value="1" @if ($level->star_value == '1') Selected @endif>1</option>
                                                        <option value="2" @if ($level->star_value == '2') Selected @endif>2</option>
                                                        <option value="3" @if ($level->star_value == '3') Selected @endif>3</option>
                                                        <option value="4" @if ($level->star_value == '4') Selected @endif>4</option>
                                                        <option value="5" @if ($level->star_value == '5') Selected @endif>5</option>
                                                        <option value="6" @if ($level->star_value == '6') Selected @endif>6</option>
                                                        <option value="7" @if ($level->star_value == '7') Selected @endif>7</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Eligibility range min:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="number" name="eligibility_range_min" value="{{ $level->eligibility_range_min }}" class="form-control"
                                                            placeholder="Enter min value" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Eligibility range max:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="number" name="eligibility_range_max" value="{{ $level->eligibility_range_max }}" class="form-control"
                                                            placeholder="Enter max value" required>
                                                    </div>
                                                </div>
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

    <script src="{{ asset('backend/assets/js/dropify.js') }}"></script>
</body>

</html>
