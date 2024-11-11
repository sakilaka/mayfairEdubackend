<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Student Application Document Edit</title>
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
                            Student Application Document Edit
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.student_appliction_list') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All Application</a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="my-2 col-md-2">
                            @include('Backend.student_appliction.theme_options_tabs_nav')
                        </div>

                        <div class="my-2 col-md-10">
                            <div class="tab-content tab-content-vertical bg-white rounded">
                                <div class="tab-pane fade show active" id="program-info-tab-content" role="tabpanel"
                                    aria-labelledby="home-tab-vertical">

                                    <form novalidate="" method="post"
                                        action="{{ route('admin.student_appliction_document-update', $s_appliction->id) }}"
                                        data-validate="parsley" id="DataEntry_formId" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row ajax-doc-res">
                                            <div class="col-lg-12 mt-3">
                                                <b>
                                                    <h4>Documents
                                                </b></h4>
                                                <hr>
                                            </div>
                                            @foreach ($s_appliction->documents as $k => $document)
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="font-weight-bold text-muted">
                                                            {{ $loop->iteration }}.
                                                            {{ __($document->document_name) }}
                                                        </label>
                                                        <div class="row align-items-center">
                                                            <div class="col-md-8">
                                                                <input type="file" class="mt-3 mb-3 form-control"
                                                                    name="old_document_file[{{ $document->id }}]"
                                                                    value="{{ $document->document_file }}" />
                                                            </div>
                                                            <div class="col-md-4">
                                                                <a class="btn btn-primary btn-sm text-light"
                                                                    data-toggle="modal"
                                                                    data-target="#certificateModal{{ $k }}">
                                                                    <i class="fa fa-solid fa-eye"
                                                                        aria-hidden="true"></i>
                                                                </a>
                                                                <a href="{{ route('admin.application-file-download', $document->id) }}"
                                                                    class="ml-1 btn btn-primary btn-sm text-light">
                                                                    <i class="fa fa-download" aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Modal -->
                                                <div class="modal fade" id="certificateModal{{ $k }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="audioModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="audioModalLabel"
                                                                    style="color: black">{{ $document->document_name }}
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if ($document->extensions == 'pdf')
                                                                    <iframe src="{{ $document->document_file_show }}"
                                                                        width="100%" height="500"></iframe>
                                                                @else
                                                                    <img src="{{ $document->document_file_show }}"
                                                                        alt="image"
                                                                        style="height: 300px; width:450px">
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>

                                        <div class="row tabs-footer mt-15">
                                            <div class="col-lg-12">
                                                <a href="{{ route('admin.student_appliction_list') }}"
                                                    class="btn blue-btn btn-danger">Cancel</a>
                                                <button type="submit" class="btn blue-btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </form>

                                    <form method="POST" action="" enctype="multipart/form-data" id="uploadForm">
                                        @csrf
                                        <input type="hidden" name="order" id="current_order">
                                            
                                        <div class="row align-items-center mt-5">
                                            <div class="form-group col-md-8">
                                                <input type="text" class="form-control" required=""
                                                    placeholder="Describe your document here…" name="title"
                                                    id="documentTitle">
                                                <span class="text-danger" id="documentTitleWarningMsg"></span>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class="input-group">
                                                    <input type="file" name="file" class="form-control"
                                                        id="upload_file" aria-describedby="file"
                                                        accept="image/*,application/pdf" required="">
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12 progress_loader d-none">
                                                <div class="dot-opacity-loader">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-12">
                                                <button id="uploadFile" type="submit" class="btn btn-primary">
                                                    <span class="spinner-border spinner-border-sm spinner d-none"
                                                        role="status" aria-hidden="true"></span>
                                                    <span class="upload-status">Upload
                                                        Document</span></button>
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

    <script>
        var student_app_id = "{{ $s_appliction->id }}";
        var current_order = "{{ $s_appliction->documents->count() }}";
        document.getElementById("upload_file").onchange = function() {
            $('.custom-file-label').text(document.getElementById("upload_file").files[0].name)

        };
        $("#uploadFile").on("click", function(e) {
            $('#documentTitleWarningMsg').text('');
            $(".progress_loader").removeClass('d-none').addClass("d-inline-block");
            $(".upload-status").text("Uploading...");

            if ($("#uploadForm")[0].checkValidity()) {
                e.preventDefault();
                current_order++;

                //set upload form values based on user application
                $("#uploadForm #email").val(jQuery("#email").val());
                $("#uploadForm #current_order").val(current_order);
                let data = new FormData($("#uploadForm")[0]);
                var url = "{{ url('/add-attachment/upload/') }}/" + student_app_id;

                $.ajax({
                    type: "post",
                    url: url,
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function(response) {
                        $(".progress_loader").removeClass('d-inline-block').addClass("d-none");
                        $(".upload-status").text("Upload document");

                        $("#uploadForm")[0].reset();
                        $('.custom-file-label').text('Choose File');
                        $('.ajax-doc-res').append(response.doc_view);
                    },
                    error: function(err) {
                        $(".upload-status").text("Upload document");
                        $('.custom-file-label').text('Choose File');
                        $(".progress_loader").removeClass('d-inline-block').addClass("d-none");
                        $("#uploadForm")[0].reset();
                    },
                });
            } else {
                e.preventDefault();
                $(".progress_loader").removeClass('d-inline-block').addClass("d-none");
                $('#documentTitleWarningMsg').text('Please add a document title and select a document to upload');
            }
        });
    </script>
</body>

</html>
