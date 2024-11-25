<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Add Scholarship</title>
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
                            Add Scholarship
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-md-9 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample" action="{{ route('admin.scholarship.store') }}"
                                        method="POST">
                                        @csrf

                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="title" class=" col-form-label">Title
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input id="title" type="text" name="title" class="form-control"
                                                    placeholder="Enter Scholarship Title" required>
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="type" class="col-form-label">Type</label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <select id="type" name="type" class="form-control form-control-lg">
                                                    <option value="" disabled selected>Select Type</option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                    <option value="D">D</option>
                                                    <option value="E">E</option>
                                                    <option value="F">F</option>
                                                    <option value="G">G</option>
                                                </select>
                                                @error('type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="scholarship_amount" class=" col-form-label">Scholarship
                                                    Amount
                                                </label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input id="scholarship_amount" type="number" name="scholarship_amount"
                                                    class="form-control" placeholder="Enter Scholarship Amount">
                                                @error('scholarship_amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="tuition_fee" class=" col-form-label">Tuition Fee
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input id="tuition_fee" type="number" name="tuition_fee"
                                                    class="form-control" placeholder="Enter Tuition Fee" required>
                                                <span class="text-muted" style="font-size: 0.85rem">
                                                    <i>
                                                        The value '1' represents as 'Free'
                                                    </i>
                                                </span>
                                                @error('tuition_fee')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                     

                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="accommodation_fee" class=" col-form-label">Accommodation Fee
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input id="accommodation_fee" type="number" name="accommodation_fee"
                                                    class="form-control" placeholder="Enter Accommodation Fee" required>
                                                <span class="text-muted" style="font-size: 0.85rem">
                                                    <i>
                                                        The value '1' represents as 'Free'
                                                    </i>
                                                </span>
                                                @error('accommodation_fee')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="insurance_fee" class=" col-form-label">Insurance Fee
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input id="insurance_fee" type="number" name="insurance_fee"
                                                    class="form-control" placeholder="Enter Insurance Fee" required>
                                                <span class="text-muted" style="font-size: 0.85rem">
                                                    <i>
                                                        The value '1' represents as 'Free'
                                                    </i>
                                                </span>
                                                @error('insurance_fee')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="stipend_monthly" class=" col-form-label">Stipend (Monthly)
                                                </label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input id="stipend_monthly" type="text" name="stipend_monthly"
                                                    class="form-control" placeholder="Enter Stipend Amount">
                                                <span class="text-muted" style="font-size: 0.85rem">
                                                    <i>
                                                        The value '1' represents as 'Free'
                                                    </i>
                                                </span>
                                                @error('stipend_monthly')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="stipend_yearly" class=" col-form-label">Stipend (Yearly)
                                                </label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input id="stipend_yearly" type="text" name="stipend_yearly"
                                                    class="form-control" placeholder="Enter Stipend Amount">
                                                <span class="text-muted" style="font-size: 0.85rem">
                                                    <i>
                                                        The value '1' represents as 'Free'
                                                    </i>
                                                </span>
                                                @error('stipend_yearly')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
