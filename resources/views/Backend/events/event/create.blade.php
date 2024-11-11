<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Add Event</title>
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
                            Add Event
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.event.index') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All</a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-md-12 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample" action="{{ route('admin.event.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row mb-3">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="row">
                                                    <div class="col-sm-12 mb-2">
                                                        <h4>Event Details</h4>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Event
                                                                Photo <span class="text-danger"
                                                                    style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                            <div class="dropify-wrapper" style="border: none">
                                                                <div class="dropify-loader"></div>
                                                                <div class="dropify-errors-container">
                                                                    <ul></ul>
                                                                </div>
                                                                <input type="file" class="dropify" name="image"
                                                                    accept="image/*" id="avatar_upload" required>
                                                                <button type="button"
                                                                    class="dropify-clear">Remove</button>
                                                                <div class="dropify-preview">
                                                                    <span class="dropify-render"></span>
                                                                    <div class="dropify-infos">
                                                                        <div class="dropify-infos-inner">
                                                                            <p class="dropify-filename">
                                                                                <span class="file-icon"></span>
                                                                                <span
                                                                                    class="dropify-filename-inner"></span>
                                                                            </p>
                                                                            <p class="dropify-infos-message">
                                                                                Drag and drop or click to replace
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-sm-6 d-flex justify-content-center align-items-center">
                                                        <div class="px-3">
                                                            <img src="{{ asset('frontend/images/No-image.jpg') }}"
                                                                alt="" class="img-fluid"
                                                                style="border-radius: 10px; max-height: 200px !important;"
                                                                id="avatar_preview">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Event Name:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Enter Event Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Category:<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <select id="cat" class="form-control form-control-lg"
                                                        name="category_id">
                                                        <option value="">Select Category</option>
                                                        @foreach ($categorys as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Start Date:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="date" name="startdate" class="form-control"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">End Date:
                                                        <span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="date" name="enddate" class="form-control"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Recording:</label>
                                                    <select class="form-control form-control-lg" name="recording">
                                                        <option value="">Select Recording</option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Event Language:</label>
                                                    <input type="text" name="language_id" class="form-control"
                                                        placeholder="Event Language(s)">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Event Fee:</label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="number" name="fee" class="form-control"
                                                            placeholder="Event Fee">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Organization Name:</label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="organization_name"
                                                            class="form-control" placeholder="Organization Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Location:</label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="location" class="form-control"
                                                            placeholder="Location">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Event Schedule :</label>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <tr class="text-center bg-primary text-white">
                                                                <th>Name</th>
                                                                <th class="text-center">Partner</th>
                                                                <th>Days</th>
                                                                <th>Date</th>
                                                                <th>Start Time</th>
                                                                <th>End Time</th>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="mg-t-10 mg-sm-t-0 add-data-schedule">
                                                        <div class="d-flex align-items-center mt-2">
                                                            <div class="d-flex align-items-center select-add-section"
                                                                style="width: 97%;">
                                                                <input type="text" name="schedulename[]"
                                                                    class="mr-1 form-control" placeholder="Event Name"
                                                                    required>
                                                                <input type="text" name="instrutor_id[]"
                                                                    class="form-control" placeholder="Speaker Name">

                                                                <input type="text" name="day_id[]"
                                                                    class="form-control" placeholder="Day Name">
                                                                <input type="text" placeholder="Date"
                                                                    name="scheduledate[]" class="ml-1 form-control"
                                                                    required>
                                                                <input type="text" placeholder="Start Time"
                                                                    name="schedulestart_time[]"
                                                                    class="ml-1 form-control" required>
                                                                <input type="text" placeholder="End Time"
                                                                    name="scheduleend_time[]"
                                                                    class="ml-1 form-control">
                                                            </div>

                                                            <a id="plus-btn-data" href="javascript:void(0)"
                                                                class="plus-btn-data-schedule px-1 p-0 m-0 ml-2"><i
                                                                    class="fas fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 mt-3">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea type="text" name="about" class="editor form-control" placeholder="Enter description"></textarea>
                                                </div>
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
    @include('Backend.components.ckeditor5-config')

    <script src="{{ asset('backend/assets/js/dropify.js') }}"></script>
    <script>
        $('#avatar_upload').on('change', function(e) {
            var fileInput = $(this)[0];

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#avatar_preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        });
    </script>

    <script>
        $('.plus-btn-data-schedule').on('click', function() {

            let mySchedule = `
                <div class="d-flex align-items-center mt-2">
                    <div class="d-flex align-items-center select-add-section"
                        style="width: 97%;">
                        <input type="text" name="schedulename[]"
                            class="mr-1 form-control" placeholder="Event Name"
                            required>
                        <input type="text" name="instrutor_id[]"
                            class="form-control" placeholder="Speaker Name">

                        <input type="text" name="day_id[]"
                            class="form-control" placeholder="Day Name">
                        <input type="text" placeholder="Date" name="scheduledate[]"
                            class="ml-1 form-control" required>
                        <input type="text" placeholder="Start Time" name="schedulestart_time[]"
                            class="ml-1 form-control" required>
                        <input type="text" placeholder="End Time" name="scheduleend_time[]"
                            class="ml-1 form-control">
                    </div>

                    <a href="javascript:void(0)"
                        class="minus-btn-data-schedule px-1 p-0 m-0 ml-2"><i
                            class="fas fa-minus"></i></a>
                </div>
            `;

            $('.add-data-schedule').append(mySchedule);
        });
        $(document).on('click', '.minus-btn-data-schedule', function() {
            $(this).parent().remove();
        });
    </script>
</body>

</html>
