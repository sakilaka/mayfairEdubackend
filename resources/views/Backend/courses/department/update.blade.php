<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Edit Major</title>
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
                            Edit Major
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-md-9 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample"
                                        action="{{ route('admin.major.update', ['id' => $major->id]) }}" method="POST">
                                        @csrf

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="major">Major Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input id="major" type="text" name="name"
                                                        class="form-control" value="{{ $major->name }}"
                                                        placeholder="Enter Major Name" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="overview">Overview
                                                    </label>
                                                    <textarea name="overview" id="overview" class="editor form-control">{!! $major->overview !!}</textarea>
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

</body>

</html>
