<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Expo Video Page</title>

    <style>
        .form-label {
            font-weight: bold;
            color: rgb(94, 94, 94)
        }
    </style>
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
                            Video Page for '{{ $expo->title }}'
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('expo.video', ['unique_id' => $expo->unique_id]) }}"
                                class="btn btn-primary btn-fw" target="_blank">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View Page
                            </a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-2">
                            @include('Backend.events.expo.media.expo-ui-manage-nav')
                        </div>

                        <div class="col-10">
                            <div class="tab-content tab-content-vertical bg-white rounded">
                                <div class="tab-pane fade show active" id="program-info-tab-content" role="tabpanel"
                                    aria-labelledby="home-tab-vertical">

                                    <form method="post"
                                        action="{{ route('admin.expo.media.video.update', ['expo_id' => $expo->unique_id]) }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        @php
                                            $contents = [];
                                            if ($expo && $expo['video']) {
                                                $contents = json_decode($expo->video, true);
                                            }
                                        @endphp

                                        <div class="row">

                                            <div class="col-sm-12">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="d-inline">Videos</h5>
                                                    <div class="d-flex">
                                                        <button type="submit" class="btn blue-btn btn-primary"
                                                            style="margin-right: 8px">Save</button>

                                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary"
                                                            id="add-photo-gallery-image">
                                                            <i class="fa fa-plus"></i>
                                                            Add
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="photo-gallery-container">
                                                    @forelse ($contents as $key => $content)
                                                        <div class="row align-items-center video-container mt-2 mb-4"
                                                            style="{{ !$loop->last ? 'border-bottom: 3px solid #ddd;' : '' }}">
                                                            <div
                                                                class="col-12 row align-items-center justify-content-between">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Video Type <span
                                                                                class="text-danger">*</span></label>
                                                                        <select name="video_type[{{ $key }}]"
                                                                            class="form-control form-control-lg video-type-selector"
                                                                            required
                                                                            onchange="toggleVideoSections(this)">
                                                                            <option value="">Choose an option
                                                                            </option>
                                                                            <option value="youtube"
                                                                                {{ $content['type'] == 'youtube' ? 'selected' : '' }}>
                                                                                Youtube Embed Code
                                                                            </option>
                                                                            <option value="upload"
                                                                                {{ $content['type'] == 'upload' ? 'selected' : '' }}>
                                                                                Video Upload
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-1">
                                                                    <a href="javascript:void(0)"
                                                                        class="remove-photo-gallery-image btn btn-danger btn-sm m-0 ml-2">
                                                                        <i class="fas fa-minus-circle"></i>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 youtube-section">
                                                                <div class="form-group">
                                                                    <label for="">Video Title<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text"
                                                                        name="video_title[{{ $key }}]"
                                                                        class="form-control form-control-lg"
                                                                        placeholder="Enter Video Title"
                                                                        value="{{ $content['title'] ?? '' }}">
                                                                </div>
                                                            </div>

                                                            <!-- Youtube Section -->
                                                            <div
                                                                class="col-12 youtube-section {{ $content['type'] == 'youtube' ? '' : 'd-none' }}">
                                                                <div class="form-group">
                                                                    <label for="">Youtube Embed Code <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text"
                                                                        name="youtube_embed_code[{{ $key }}]"
                                                                        class="form-control form-control-lg"
                                                                        placeholder="Enter Youtube Embed Code"
                                                                        value="{{ $content['type'] == 'youtube' ? $content['url'] : '' }}">
                                                                </div>
                                                            </div>

                                                            <!-- Upload Section -->
                                                            <div
                                                                class="col-12 row upload-section {{ $content['type'] == 'upload' ? '' : 'd-none' }}">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="upload_video">Upload Video</label>
                                                                        <input type="file"
                                                                            name="video_upload[{{ $key }}]"
                                                                            class="form-control video-upload"
                                                                            accept="video/*">
                                                                        <input type="hidden"
                                                                            name="old_photo_gallery_image[{{ $key }}]"
                                                                            value="{{ $content['type'] == 'upload' ? $content['url'] : '' }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div
                                                                        class="form-group video-preview-container {{ $content['type'] != 'upload' ? 'd-none' : '' }}">
                                                                        <label>Video Preview:</label>
                                                                        <video class="video-preview"
                                                                            style="width: 100%; max-height: 200px;"
                                                                            controls>
                                                                            <source
                                                                                src="{{ $content['type'] == 'upload' ? $content['url'] : '' }}"
                                                                                type="video/mp4">
                                                                            Your browser does not support the video tag.
                                                                        </video>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="row align-items-center video-container mt-2 mb-4"
                                                            style="border-bottom: 3px solid #ddd">
                                                            @php
                                                                $random = rand(10000, 99999);
                                                            @endphp

                                                            <div
                                                                class="col-12 row align-items-center justify-content-between">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Video Type <span
                                                                                class="text-danger">*</span></label>
                                                                        <select name="video_type[{{ $random }}]"
                                                                            class="form-control form-control-lg video-type-selector"
                                                                            required>
                                                                            <option value="">Choose an option
                                                                            </option>
                                                                            <option value="youtube">Youtube Embed Code
                                                                            </option>
                                                                            <option value="upload">Video Upload</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-1">
                                                                    <a href="javascript:void(0)"
                                                                        class="remove-photo-gallery-image btn btn-danger btn-sm m-0 ml-2">
                                                                        <i class="fas fa-minus-circle"></i>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                            <!-- Video Title Section -->
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="">Video Title<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text"
                                                                        name="video_title[{{ $random }}]"
                                                                        class="form-control form-control-lg"
                                                                        placeholder="Enter Video Title">
                                                                </div>
                                                            </div>

                                                            <!-- Youtube Section -->
                                                            <div class="col-12 youtube-section d-none">
                                                                <div class="form-group">
                                                                    <label for="">Youtube Embed Code <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text"
                                                                        name="youtube_embed_code[{{ $random }}]"
                                                                        class="form-control form-control-lg"
                                                                        placeholder="Enter Youtube Embed Code">
                                                                </div>
                                                            </div>

                                                            <!-- Upload Section -->
                                                            <div class="col-12 row upload-section d-none">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="upload_video">Upload Video</label>
                                                                        <input type="file"
                                                                            name="video_upload[{{ $random }}]"
                                                                            class="form-control video-upload"
                                                                            accept="video/*">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div
                                                                        class="form-group video-preview-container d-none">
                                                                        <label>Video Preview:</label>
                                                                        <video class="video-preview"
                                                                            style="width: 100%; max-height: 200px;"
                                                                            controls>
                                                                            <source src="" type="video/mp4">
                                                                            Your browser does not support the video tag.
                                                                        </video>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforelse

                                                </div>
                                            </div>

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
    <script>
        $(document).on('change', `.dropify`, function() {
            var fileInput = $(this)[0];
            var uploadSelector = $(this);

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(uploadSelector).closest('.img-upload-container')
                        .siblings('.img-preview-container')
                        .find('img')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        });

        /* add photo gallery image */
        $('#add-photo-gallery-image').on('click', function() {
            var randomNumber = Math.floor(10000 + Math.random() * 90000);

            var myvar = `
                <div class="row align-items-center video-container mt-2 mb-4" style="border-bottom: 3px solid #ddd">
                    <div class="col-12 row align-items-center justify-content-between">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Video Type <span class="text-danger">*</span></label>
                                <select name="video_type[${randomNumber}]"
                                    class="form-control form-control-lg video-type-selector"
                                    required>
                                    <option value="">Choose an option</option>
                                    <option value="youtube">Youtube Embed Code</option>
                                    <option value="upload">Video Upload</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-1">
                            <a href="javascript:void(0)"
                                class="remove-photo-gallery-image btn btn-danger btn-sm m-0 ml-2">
                                <i class="fas fa-minus-circle"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Video Title Section -->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Video Title<span class="text-danger">*</span></label>
                            <input type="text" name="video_title[${randomNumber}]"
                                class="form-control form-control-lg"
                                placeholder="Enter Video Title">
                        </div>
                    </div>

                    <!-- Youtube Section -->
                    <div class="col-12 youtube-section d-none">
                        <div class="form-group">
                            <label for="">Youtube Embed Code <span class="text-danger">*</span></label>
                            <input type="text" name="youtube_embed_code[${randomNumber}]"
                                class="form-control form-control-lg"
                                placeholder="Enter Youtube Embed Code">
                        </div>
                    </div>

                    <!-- Upload Section -->
                    <div class="col-12 row upload-section d-none">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="upload_video">Upload Video</label>
                                <input type="file" name="video_upload[${randomNumber}]"
                                    class="form-control video-upload" accept="video/*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group video-preview-container d-none">
                                <label>Video Preview:</label>
                                <video class="video-preview" style="width: 100%; max-height: 200px;" controls>
                                    <source src="" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            $('.photo-gallery-container').prepend(myvar);
            $(`.dropify`).dropify();
        });

        $(document).on('click', '.remove-photo-gallery-image', function() {
            $(this).closest('.video-container').remove();
        });
    </script>

    <script>
        $(document).on('change', '.video-type-selector', function() {
            var $parent = $(this).closest('.video-container');
            var selectedType = $(this).val();

            if (selectedType === 'youtube') {
                $parent.find('.youtube-section').removeClass('d-none');
                $parent.find('.upload-section').addClass('d-none');
            } else if (selectedType === 'upload') {
                $parent.find('.upload-section').removeClass('d-none');
                $parent.find('.youtube-section').addClass('d-none');
            } else {
                $parent.find('.youtube-section').addClass('d-none');
                $parent.find('.upload-section').addClass('d-none');
            }
        });

        $(document).on('change', '.video-upload', function(e) {
            var file = e.target.files[0];
            var $parent = $(this).closest('.upload-section');

            if (file && file.type.startsWith('video/')) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var videoSrc = e.target.result;
                    $parent.find('.video-preview-container').removeClass('d-none');
                    $parent.find('.video-preview source').attr('src', videoSrc);
                    $parent.find('.video-preview')[0].load();
                };

                reader.readAsDataURL(file);
            } else {
                $parent.find('.video-preview-container').addClass('d-none');
            }
        });

        $('.video-type-selector').trigger('change');
    </script>
</body>

</html>
