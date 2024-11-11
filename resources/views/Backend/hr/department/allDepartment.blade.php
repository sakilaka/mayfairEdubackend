@extends('Backend.layouts.layouts')

@section('title', 'View All Department')


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
                    <h1 class="">View All Department</h1>
                    <br>
                </div>
              <!-- <input type="text" placeholder="Search Data" id="myInput">
              <a href="{{ route('addDepartment') }}" class="btn btn-primary btn-sm float-right">Add Department</a>
                  <br>
                  <br> -->
            <div class="row">
                <div class="col-md-3">
                    <input type="text" id="myInput" class="form-control" placeholder="Search">
                </div>
                <div class="col-md-9 text-right" >
                    <a href="{{ route('addDepartment') }}" class="btn btn-info">
                       <i class="fa fa-plus ml-0 mr-1"></i> Add Department
                    </a>
                </div>
            </div>
                <table class="table table-striped" id="dataTable">
                  <thead>
                    <tr>
                      <th scope="col">SN</th>
                      <th scope="col">Department Name</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="dataTable" >
                      @foreach ($departmentData as $i=>$dept)
                      @php
                      $total = 0
                    @endphp
                        <tr>
                          <th scope="row">{{ $i+1 }}</th>
                          <td>{{ $dept->name }}</td>


                          <td>
                              <a  class="btn text-info"  href="{{ url('/editDepartment') }}/{{ $dept->id }}" >
                                <i class="icon ion-compose tx-28"></i>
                              </a>
                              <a class="btn text-danger bg-white" href="{{ url('deleteDept') }}/{{ $dept->id }}">
                                  <i class="icon ion-trash-a tx-28"></i>
                              </a>
                          </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
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
</script>
<!-- </div> -->
@stop
