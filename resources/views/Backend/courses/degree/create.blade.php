<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Add Degree</title>
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
                            Add Degree
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-md-9 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample" action="{{ route('admin.degree.store') }}" method="POST">
                                        @csrf
                                        
                                        {{-- <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="page_url" class=" col-form-label">Department
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <select class="form-control form-control-lg" name="department_id"
                                                    id="page_url" required>
                                                    <option value="">Select Department</option>
                                                    @foreach ($departments as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}

                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="degree_name" class=" col-form-label">Degree Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input id="degree_name" type="text"
                                                    name="name" class="form-control" placeholder="Enter Degree Name" required>
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
