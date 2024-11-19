<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Edit Scholarship</title>
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
                            Edit Scholarship
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-md-9 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample"
                                        action="{{ route('admin.scholarship.update', ['id' => $scholarship->id]) }}"
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
                                                    placeholder="Enter Scholarship Title"
                                                    value="{{ $scholarship->title }}" required>
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
                                                    <option value="" disabled
                                                        {{ !$scholarship->type ? 'selected' : '' }}>Select Type</option>
                                                    <option value="A"
                                                        {{ $scholarship->type == 'A' ? 'selected' : '' }}>A</option>
                                                    <option value="B"
                                                        {{ $scholarship->type == 'B' ? 'selected' : '' }}>B</option>
                                                    <option value="C"
                                                        {{ $scholarship->type == 'C' ? 'selected' : '' }}>C</option>
                                                    <option value="D"
                                                        {{ $scholarship->type == 'D' ? 'selected' : '' }}>D</option>
                                                    <option value="E"
                                                        {{ $scholarship->type == 'E' ? 'selected' : '' }}>E</option>
                                                    <option value="F"
                                                        {{ $scholarship->type == 'F' ? 'selected' : '' }}>F</option>
                                                    <option value="G"
                                                        {{ $scholarship->type == 'G' ? 'selected' : '' }}>G</option>
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
                                                <input id="scholarship_amount" type="number"
                                                    value="{{ $scholarship->scholarship_amount }}"
                                                    name="scholarship_amount" class="form-control"
                                                    placeholder="Enter Scholarship Amount">
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
                                                    class="form-control" value="{{ $scholarship->tuition_fee }}"
                                                    placeholder="Enter Tuition Fee" required>
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
                                                    class="form-control" placeholder="Enter Accommodation Fee"
                                                    value="{{ $scholarship->accommodation_fee }}" required>
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
                                                    class="form-control" value="{{ $scholarship->insurance_fee }}"
                                                    placeholder="Enter Insurance Fee" required>
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
                                                    class="form-control" placeholder="Enter Stipend Amount"
                                                    value="{{ $scholarship->stipend_monthly }}">
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
                                                    class="form-control" placeholder="Enter Stipend Amount"
                                                    value="{{ $scholarship->stipend_yearly }}">
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

                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="stipend" class=" col-form-label">Status
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <select name="status" id="status"
                                                    class="form-control form-control-lg">
                                                    <option value="">Select Status</option>
                                                    <option value="1"
                                                        @if ($scholarship->status == 1) selected @endif>Active
                                                    </option>
                                                    <option value="0"
                                                        @if ($scholarship->status == 0) selected @endif>Inactive
                                                    </option>
                                                </select>
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

</body>

</html>
