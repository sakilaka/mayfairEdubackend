@extends('Backend.layouts.layouts')

@section('title', 'Manage Late Roll')


@section('main_contain')

<div class="br-mainpanel">

          <div class="br-section-wrapper">

                <div class="text-center mb-4">
                    <h1 class="">Manage Late Roll</h1>
                    <br>
                </div>

              <input type="text" placeholder="Search Data" id="myInput">
                @if($viewAll->count() == 0)
              <a href="{{ route('addLateRoll') }}" class="btn btn-info btn-sm float-right">Add Late Roll</a>
                @endif
                  <br>
                  <br>
                <table class="table table-striped" id="dataTable">
                  <thead>
                    <tr>
                      <th scope="col">SL</th>
                      <th scope="col">Late</th>
                      <th scope="col">Absent</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="dataTable" >

                      <tr>
                      @foreach ($viewAll as $i=>$data)
                        <tr>
                          <th scope="row">{{ $i+1 }}</th>
                          <th scope="row">{{$data->late}}</th>
                          <th scope="row">{{$data->absent}}</th>
                          <td>
                              <a href="{{ url('editLateRoll') }}/{{ $data->id }}" class="btn text-info">
                                   <i class="icon ion-compose tx-28"></i>
                              </a>
                              {{-- <a href="{{ url('deleteLateRoll') }}/{{ $data->id }}" class="btn text-danger bg-white">
                                  <i class="icon ion-trash-a tx-28"></i>
                              </a> --}}
                          </td>
                        </tr>
                      @endforeach

                      </tr>

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
