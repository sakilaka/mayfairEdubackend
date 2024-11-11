@extends('Backend.layouts.layouts')

@section('title', 'Page Title')


@section('main_contain')
<div class="br-mainpanel">

    <!-- <div class="br-pagetitle">
      <i class="fa-duotone fa-gear"></i>
      <div>
        <h4>View All Category</h4>
        <p class="mg-b-0">All Category Details Here</p>
      </div>
    </div>d-flex -->


      <!-- <div class="p-5"> -->

          <div class="br-section-wrapper">

                <div class="text-center mb-4">
                    <h1 class="">Manage Leave Applications Details</h1>
                    <br>
                </div>

              <input type="text" placeholder="Search Data" id="myInput">
              <a href="{{ route('addLeave') }}" class="btn btn-info btn-sm float-right">Add Leave Details</a>
                  <br>
                  <br>
                <table class="table table-striped" id="dataTable">
                  <thead>
                    <tr>
                      <th scope="col">SN</th>
                      <th scope="col">Employee Name</th>
                      <th scope="col">Employee Id</th>
                      <th scope="col">Leave Type</th>
                      <th scope="col">Reason</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="dataTable" >
                      @foreach ($viewAll as $i=>$data)
                        <tr>
                          <th scope="row">{{ $i+1 }}</th>

                          <td>{{ $data->employee->employee_name }}</td>
                          <td>{{ $data->employee->employee_id }}</td>

                          <td>
                            {{ $data->leave_type }}
                          </td>
                          <td>
                            {{ $data->reason }}
                          </td>
                          <td>
                            {{ $data->status == 1  ? "Approved" :  "Pending"  }}
                          </td>
                          <td>
                              <a href="{{ url('editLeave') }}/{{ $data->id }}" class="btn text-info">
                                  <i class="icon ion-compose tx-28"></i>
                              </a>
                              <a href="{{ url('deleteLeave') }}/{{ $data->id }}" class="btn text-danger bg-white">
                                  <i class="icon ion-trash-a tx-28"></i>
                              </a>
                          </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
          </div>
      </div>
      @endsection
      @section('script')
      <script>
$(document).ready(function(){
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#dataTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/alfrcr/paginathing/dist/paginathing.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function ($) {
    const listElement = $('.list-group');

    for (let i = 1; i <= 1500; i++) {
      listElement.append('<li class="list-group-item"> Item ' + i + '</li>');
    }

    listElement.paginathing({
      perPage: 5,
      limitPagination: 9,
      containerClass: 'panel-footer mt-4',
      pageNumbers: true,
      ulClass: 'pagination flex-wrap justify-content-center',
    })

    $('.table tbody').paginathing({
      perPage: 10,
      insertAfter: '.table',
    //   pageNumbers: true,
      ulClass: 'pagination flex-wrap justify-content-center'
    });
  });
</script>
<!-- </div> -->
@endsection
