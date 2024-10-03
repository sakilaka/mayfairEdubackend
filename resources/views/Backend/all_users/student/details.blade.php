<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Student Details of {{ $student->name }}</title>
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
                            Student Details of {{ $student->name }}
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.student.index') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                View All Student</a>
                        </nav>
                    </div>

                    <div class="card">
                        <div class="card-body p-5">
                            <div>
                                <div class="col-12 d-flex justify-content-center my-3">
                                    <h4 class="page-title">
                                        Personal Details
                                    </h4>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-sm-4">
                                        <label class="form-control-label"><b>Student Image: </b></label>
                                        <div class="mt-1 mr-2"
                                            style="position:relative;box-shadow: 0px 0px 1px 1px;width: 150px;">
                                            <img class="display-upload-img" style="width: 150px;height: 70px;"
                                                src="{{ $student->image_show }}" alt="">

                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-sm-4">
                                        <label class="form-control-label"><b>Student Name: </b></label>
                                        <div class="mg-t-10 mg-sm-t-0">
                                            {{ $student->name }}
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-control-label"><b>Mobile Number: </b></label>
                                        <div class="cmg-t-10 mg-sm-t-0">
                                            {{ $student->mobile }}
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-control-label"><b>Email: </b></label>
                                        <div class="mg-t-10 mg-sm-t-0">
                                            {{ $student->email }}
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-sm-4">
                                        <label class=" form-control-label"><b>NID:</b></label>
                                        <div class="mg-t-10 mg-sm-t-0">
                                            {{ $student->nid }}
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class=" form-control-label"><b>Gender:</b></label>
                                        <div class="mg-t-10 mg-sm-t-0">
                                            @if (@$student->gender == '0')
                                                Male
                                            @elseif (@$gender->language == '1')
                                                Female
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class=" form-control-label"><b>Date of Birth:</b></label>
                                        <div class="mg-t-10 mg-sm-t-0">
                                            {{ date('d-m-Y', strtotime($student->dob)) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-sm-4">
                                        <label class=" form-control-label"><b>Qualification:</b></label>
                                        <div class="mg-t-10 mg-sm-t-0">
                                            {{ @$student->qualification }}
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class=" form-control-label"><b>Experience:</b></label>
                                        <div class="mg-t-10 mg-sm-t-0">
                                            {{ @$student->experience }}
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class=" form-control-label"><b>Language:</b></label>
                                        <div class="mg-t-10 mg-sm-t-0">

                                            @if (@$student->language == '1')
                                                Bangla
                                            @elseif (@$student->language == '2')
                                                English
                                            @elseif (@$student->language == '3')
                                                Hindi
                                            @elseif (@$student->language == '4')
                                                Arabic
                                            @endif

                                        </div>
                                    </div>



                                </div>

                                <div class="row mt-4">
                                    <div class="col-sm-4">
                                        <label class=" form-control-label"><b>Continent:</b></label>
                                        <div class="mg-t-10 mg-sm-t-0">
                                            {{ $student->continents?->name }}
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class=" form-control-label"><b>Country:</b></label>
                                        @php
                                            $country_name = App\Models\Country::where(
                                                'continent_id',
                                                $student->continent_id,
                                            )->value('name');
                                        @endphp
                                        <div class="mg-t-10 mg-sm-t-0">
                                            {{ $country_name }}
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class=" form-control-label"><b>Address:</b></label>
                                        <div class="mg-t-10 mg-sm-t-0">
                                            {{ $student->address }}
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-sm-12">
                                        <label class=" form-control-label"><b>Description:</b></label>
                                        <div class="mg-t-10 mg-sm-t-0">
                                            {!! $student->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <div class="col-12 d-flex justify-content-center my-3">
                                    <h4 class="page-title">
                                        Certificates
                                    </h4>
                                </div>

                                <div class="mg-t-10 mg-sm-t-0 add-data-content">
                                    @if ($student->certificate->count() == 0)
                                        <h6 class="text-center">Certificates Not Found</h6>
                                    @else
                                        @foreach ($student->certificate as $k => $item)
                                            <div class="d-flex align-items-center mt-2 row">
                                                <div class="col-md-10">
                                                    <label class="form-control-label"><b><b>Certificate
                                                                Name:</b></b></label>
                                                    <div class="d-flex  align-items-center select-add-section ">
                                                        {{ $item->certificates_name }}
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-control-label"><b><b>View:</b></b></label>
                                                    <div class="d-flex  align-items-center select-add-section">
                                                        <a class="btn btn-primary" data-toggle="modal"
                                                            data-target="#certificateModal{{ $k }}">
                                                            &nbsp;<i class="fa fa-solid fa-eye"
                                                                style="color: white"></i></a>
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
                                                                style="color: black">{{ $item->certificates_name }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if ($item->extension == 'pdf')
                                                                <iframe src="{{ $item->certificates_file_show }}"
                                                                    width="100%" height="500"></iframe>
                                                            @else
                                                                <img src="{{ $item->certificates_file_show }}"
                                                                    alt="image" style="height: 300px; width:450px">
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
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center my-3">
                        <a href="{{ route('admin.student.index') }}" class="btn btn-primary">Go Back</a>
                    </div>
                </div>

                @include('Backend.components.footer')
            </div>
        </div>
    </div>

    @include('Backend.components.script')
</body>

</html>
