@extends('Backend.layouts.layouts')

@section('title', 'Page Title')


@section('main_contain')
<div class="br-mainpanel">

    <!-- <div class="br-pagetitle">
      <i class="fa-duotone fa-gear"></i>
      <div>
        <h4>View All Salary</h4>
        <p class="mg-b-0">All Salary Details Here</p>
      </div>
    </div>d-flex -->


      <!-- <div class="p-5"> -->

          <div class="br-section-wrapper" id="print">
                <div class="text-center mb-4">
                    <h1 class="">Manage Salary</h1>
                    <br>
                </div>

              <input type="text" placeholder="Search Data" id="myInput">
              <a href="{{ route('addSalary') }}" class="btn btn-info btn-sm float-right">Add Salary</a>
                  <br>
                  <br>
                <table class="table table-striped" id="dataTable">
                  <thead>
                    <tr>
                    <th>SN.</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Employee Id</th>
                    <th>Net Salary</th>
                    <th>Advanced</th>
                    <th>Paid</th>
                    <th>Percent</th>
                    <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="dataTable" >
                      @foreach ($allData as $i=>$data)
                        <tr>
                        <th scope="row">{{ $i+1 }}</th>


                        <td>{{ $data->employee->employee_name }}</td>
                        <td>{{ $data->employee->employee_id }}</td>
                        <td>{{$data->netSalary}}</td>
                        <td>{{$data->advanced}}</td>
                        <td>{{$data->paidSalary}}</td>
                        <td>{{$data->percentPaid}}</td>
                        <td>
                            <span  data-token="{{csrf_token()}}" id="salarySheetEdit" data-id="{{$data->id}}" data-toggle="modal" data-target="#updateModal">
                                <i class="fas fa-edit text-success"></i>
                            </span>
                            <span  data-token="{{csrf_token()}}" id="salarySlipFetch" data-id="{{$data->id}}" data-toggle="modal" data-target="#salarySlip">
                                <i class="fas fa-eye text-default"></i>
                            </span>

                        </td>
                        {{-- <td><button class="btn btn-info">{{ $data->status }}</button></td>
                          <td>
                              <a href="/editSalary/{{ $data->id }}">
                                  <i class="fa-duotone fa-edit  btn btn-sm btn-success"></i>
                              </a>
                              <a href="/deleteSalary/{{ $data->id }}" >
                                  <i class="fa-duotone fa-trash-can btn btn-sm btn-danger"></i>
                              </a>
                          </td> --}}
                        </tr>
                      @endforeach

                  </tbody>
                </table>

                 <center>
                    {{-- <button id="print" onclick="printDiv()" class="btn btn-primary">Print</button> --}}
                </center>

          </div>
      </div>
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

    function printDiv(){
        var mywindow = window.open();
        var content = document.getElementById("print").innerHTML;
        var realContent = document.body.innerHTML;
        mywindow.document.write(content);
        mywindow.document.close();
        mywindow.focus();
        mywindow.print();
        document.body.innerHTML = realContent;
        mywindow.close();
        return true;
    }
</script>
<!-- </div> -->
@stop
