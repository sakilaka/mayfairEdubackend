<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Edit Event</title>
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
                            Edit Event
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
                                    <form class="forms-sample" action="{{ route('admin.event.update', $events->id) }}"
                                        method="POST" enctype="multipart/form-data">
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
                                                                    accept="image/*" id="avatar_upload">
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
                                                            <img src="{{ $events->image_show ?? asset('frontend/images/No-image.jpg') }}"
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
                                                            placeholder="Enter Event Name" value="{{ $events->name }}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Category:<span class="text-danger"
                                                            style="font-size: 1.25rem; line-height:0;">*</span></label>
                                                    <select class="form-control form-control-lg" name="category_id"
                                                        id="cat">
                                                        <option value="">Select Category</option>
                                                        @foreach ($categorys as $category)
                                                            <option @if ($category->id == $events->category_id) Selected @endif
                                                                value="{{ $category->id }}">{{ $category->name }}
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
                                                        <input type="date" name="startdate"
                                                            value="{{ $events->startdate }}" class="form-control"
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
                                                        <input type="date" name="enddate"
                                                            value="{{ $events->enddate }}" class="form-control"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Recording:</label>
                                                    <select class="form-control form-control-lg" name="recording">
                                                        <option value="">Select Recording</option>
                                                        <option @if ($events->recording == '1') Selected @endif
                                                            value="1">Yes</option>
                                                        <option @if ($events->recording == '0') Selected @endif
                                                            value="0">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Event Language:</label>
                                                    <input type="text" name="language_id" class="form-control"
                                                        placeholder="Event Language(s)"
                                                        value="{{ $events->language_id }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Event Fee:</label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="number" name="fee" class="form-control"
                                                            placeholder="Event Fee" value="{{ $events->fee }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label">Organization Name:</label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="organization_name"
                                                            class="form-control"
                                                            value="{{ $events->organization_name }}"
                                                            placeholder="Organization Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Location:</label>
                                                    <div class="mg-t-10 mg-sm-t-0">
                                                        <input type="text" name="location" class="form-control"
                                                            placeholder="Location" value="{{ $events->location }}">
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
                                                        @if ($events->eventschedules->count() == 0)
                                                            <div class="d-flex align-items-center mt-2">
                                                                <div class="d-flex align-items-center select-add-section"
                                                                    style="width: 97%;">
                                                                    <input type="text" name="schedulename[]"
                                                                        class="mr-1 form-control"
                                                                        placeholder="Event Name" required>
                                                                    <input type="text" name="instrutor_id[]"
                                                                        class="form-control"
                                                                        placeholder="Speaker Name">

                                                                    <input type="text" name="day_id[]"
                                                                        class="form-control" placeholder="Day Name">
                                                                    <input type="text" placeholder="Date"
                                                                        name="scheduledate[]"
                                                                        class="ml-1 form-control" required>
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
                                                        @else
                                                            @foreach ($events->eventschedules as $k => $eventschedule)
                                                                <div class="d-flex align-items-center mt-2">
                                                                    <div class="d-flex align-items-center select-add-section"
                                                                        style="width: 97%;">
                                                                        <input type="text"
                                                                            name="old_schedulename[{{ $eventschedule->id }}]"
                                                                            class="mr-1 form-control"
                                                                            placeholder="Enter name"
                                                                            value="{{ $eventschedule->schedulename }}">
                                                                        <input type="text"
                                                                            name="old_instrutor_id[{{ $eventschedule->id }}]"
                                                                            class="form-control"
                                                                            placeholder="Speaker Name"
                                                                            value="{{ $eventschedule->instrutor_id }}">

                                                                        <input type="text"
                                                                            name="old_day_id[{{ $eventschedule->id }}]"
                                                                            class="form-control"
                                                                            placeholder="Day Name"
                                                                            value="{{ $eventschedule->day_id }}">

                                                                        <input type="text"
                                                                            name="old_scheduledate[{{ $eventschedule->id }}]"
                                                                            value="{{ $eventschedule->scheduledate }}"
                                                                            class="ml-1 form-control"
                                                                            placeholder="Date">
                                                                        <input type="text"
                                                                            name="old_schedulestart_time[{{ $eventschedule->id }}]"
                                                                            value="{{ $eventschedule->schedulestart_time }}"
                                                                            class="ml-1 form-control"
                                                                            placeholder="Start Time">
                                                                        <input type="text"
                                                                            name="old_scheduleend_time[{{ $eventschedule->id }}]"
                                                                            value="{{ $eventschedule->scheduleend_time }}"
                                                                            class="ml-1 form-control"
                                                                            placeholder="End Time">


                                                                    </div>
                                                                    @if ($k == $events->eventschedules->count() - 1)
                                                                        <a id="plus-btn-data"
                                                                            href="javascript:void(0)"
                                                                            class="plus-btn-data-schedule px-1 p-0 m-0 ml-2"><i
                                                                                class="fas fa-plus"></i></a>
                                                                    @else
                                                                        <a eventschedule_id="{{ $eventschedule->id }}"
                                                                            href="javascript:void(0)"
                                                                            class="minus-btn-data-old-schedule px-1 p-0 m-0 ml-2"><i
                                                                                class="fas fa-minus-circle"></i></a>
                                                                    @endif
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 mt-3">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea type="text" name="about" class="editor form-control" placeholder="Enter description">{!! $events->about !!}</textarea>
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
        $(document).on('click', '.minus-btn-data-old-schedule ', function() {
            $(this).parent().parent().append('<input type="hidden" name="delete_eventschedule[]" value="' + $(this)
                .attr('eventschedule_id') + '">');
            $(this).parent().remove();
        });
    </script>

</html>
