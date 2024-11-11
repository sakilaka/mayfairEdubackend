@extends('Backend.layouts.layouts')

@section('title', 'View All Designation')


@section('main_contain')
<div class="br-mainpanel">

          <div class="br-section-wrapper">

                <div class="text-center mb-4">
                    <h1 class="">View All Designation</h1>
                    <br>
                </div>

            <div class="row">
                <div class="col-md-3">
                    <input type="text" id="myInput" class="form-control" placeholder="Search">
                </div>
                <div class="col-md-9 text-right" >
                    <a href="{{ route('addDesignation') }}" class="btn btn-info">
                        {{-- <i class="fa-solid fa-plus"></i>  --}}
                        Add Designation
                    </a>
                </div>
            </div>
                <table class="table table-striped" id="dataTable">
                  <thead>
                    <tr>
                      <th scope="col">SN</th>
                      <th scope="col">Department</th>
                      <th scope="col">Designation Name</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="dataTable" >
                      @foreach ($designationData as $i=>$desg)

                        <tr>
                          <th scope="row">{{ $i+1 }}</th>
                          <td>
                             @foreach ($department as $cat)
                            @if ($cat->id == $desg->department_id)
                                {{ $cat->name }}
                            @endif
                            @endforeach
                          </td>
                          <td>{{ $desg->name }}</td>
                          <td>
                              <a class="btn text-info" href="{{ url('editDesignation') }}/{{ $desg->id }}" >
                                 <i class="icon ion-compose tx-28"></i>
                              </a>
                              <a class="btn text-danger bg-white" href="{{ url('deleteDesg') }}/{{ $desg->id }}">
                                 <i class="icon ion-trash-a tx-28"></i>
                                  {{-- <i class="fa-duotone fa-trash-can btn btn-sm btn-danger"></i> --}}
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
