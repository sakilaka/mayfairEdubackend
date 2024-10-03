<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Edit Consultation</title>
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
                            Edit Consultation
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.get_consultation.index') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View All Consultation
                            </a>
                        </nav>
                    </div>

                    <div class="row card">
                        <div class="col-md-12 p-4 form-container">
                            <form action="{{ route('admin.get_consultation.update', ['id' => $consultation['id']]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <!-- Full Name Field -->
                                    <div class="col-12 col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                                name="name" placeholder="Enter Full Name"
                                                value="{{ old('name', $consultation['name'] ?? '') }}" required>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Phone Number Field -->
                                    <div class="col-12 col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>Phone Number <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control form-control-lg @error('phone') is-invalid @enderror"
                                                name="phone" placeholder="Whatsapp/WeChat/Telegram/Line"
                                                value="{{ old('phone', $consultation['phone'] ?? '') }}" required>
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email Field -->
                                    <div class="col-12 col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text"
                                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                name="email" placeholder="Enter Email Address"
                                                value="{{ old('email', $consultation['email'] ?? '') }}">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Interested Major Field -->
                                    <div class="col-12 col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>Interested Major</label>
                                            <input type="text"
                                                class="form-control form-control-lg @error('major') is-invalid @enderror"
                                                name="major" placeholder="Enter Degree"
                                                value="{{ old('major', $consultation['major'] ?? '') }}">
                                        </div>
                                    </div>

                                    <!-- Interested Degree Field -->
                                    <div class="col-12 col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>Interested Degree</label>
                                            <input type="text"
                                                class="form-control form-control-lg @error('degree') is-invalid @enderror"
                                                name="degree" placeholder="Enter Degree"
                                                value="{{ old('degree', $consultation['degree'] ?? '') }}">
                                        </div>
                                    </div>

                                    <!-- Last Academic Result Field -->
                                    <div class="col-12 col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>Last Academic Result</label>
                                            <input type="text"
                                                class="form-control form-control-lg @error('result') is-invalid @enderror"
                                                name="result" placeholder="Enter Result"
                                                value="{{ old('result', $consultation['result'] ?? '') }}">
                                        </div>
                                    </div>

                                    <!-- Status Dropdown Field -->
                                    <div class="col-12 col-md-6 mt-2">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select id="status"
                                                class="form-control form-control-lg @error('status') is-invalid @enderror"
                                                name="status">
                                                <option value="" disabled>Select Status</option>
                                                <option value="Submitted"
                                                    {{ old('status', $consultation['status'] ?? '') == 'Submitted' ? 'selected' : '' }}>
                                                    Submitted</option>
                                                <option value="In Process"
                                                    {{ old('status', $consultation['status'] ?? '') == 'In Process' ? 'selected' : '' }}>
                                                    In Process</option>
                                                <option value="File Opened"
                                                    {{ old('status', $consultation['status'] ?? '') == 'File Opened' ? 'selected' : '' }}>
                                                    File Opened</option>
                                                <option value="Completed"
                                                    {{ old('status', $consultation['status'] ?? '') == 'Completed' ? 'selected' : '' }}>
                                                    Completed</option>
                                            </select>
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Note Textarea Field -->
                                    <div class="col-12 mt-2">
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea id="note" class="form-control form-control-lg @error('note') is-invalid @enderror" name="note"
                                                rows="3" placeholder="Enter Note">{{ old('note', $consultation['note'] ?? '') }}</textarea>
                                            @error('note')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-12 mt-5 text-center">
                                        <button type="submit" class="btn btn-primary-bg">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                @include('Backend.components.footer')
            </div>
        </div>
    </div>

    @include('Backend.components.script')

    <script src="{{ asset('backend/lib/select2/js/select2.min.js') }}"></script>
    <script>
        $('.select2').select2({
            placeholder: 'Select an option'
        });
    </script>
</body>

</html>
