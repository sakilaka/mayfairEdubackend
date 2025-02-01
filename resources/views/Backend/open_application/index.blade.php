<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | All Open Appliction List</title>

</head>

<body>
    <div class="container-scroller">
        @include('Backend.components.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('Backend.components.sidebar')

            <div class="main-panel">
                <div class="p-3">
                    <h4 class="mt-3 mb-5">All Open Application List</h4>
                    <div class="bg-white p-3">

                        <table class="my-3 p-2" id="applicationsTable" class="display" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Serial No.</th>
                                    <th>Student Name</th>
                                    <th>Passport</th>
                                    <th>Gender</th>
                                    <th>Country</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
    
                            <tbody>
                                @foreach($applications as $index => $application)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $application->first_name }}</td>
                                        <td>{{ $application->passport_number }}</td>
                                        <td>{{ $application->gender }}</td>
                                        <td>{{ $application->home_country }}</td>
                                        <td>
                                            {{-- <a href="{{ route('application.edit', $application->id) }}" class="btn btn-warning">Edit</a>
                                            <a href="{{ route('application.delete', $application->id) }}" class="btn btn-danger">Delete</a> --}}
                                            <a href="{{ route('admin.open_application_details', $application->id) }}" class="text-black">
                                                 <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route('admin.open-application-form-download', $application->id) }}" class="text-black" style="margin-left: 20px;">
                                                 <i class="fa fa-download" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                


                @include('Backend.components.footer')
            </div>
        </div>
    </div>

    @include('Backend.components.script')



    <script type="text/javascript">
    $(document).ready(function() {
        $('#applicationsTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    title: 'Applications List'
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    title: 'Applications List'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    title: 'Applications List'
                }
            ],
            "order": [[ 0, "asc" ]]  ,
            stripeClasses: ['table-light', 'table-white'], 
        });
    });
</script>

</body>

</html>
