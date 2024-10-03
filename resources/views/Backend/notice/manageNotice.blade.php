@extends('Backend.layouts.layouts')

@section('title', 'All Notice')


<link rel="stylesheet" href="{{ URL::asset('css/custom/eduStc.css') }}">

@section('main_contain')

<div class="br-mainpanel">

            <div class="br-section-wrapper">
                <div class="text-center mb-4">
                    <h1 class="">Manage all Notice</h1>
                    <br>
                </div>

            <!-- <div class="row">
                <div class="col-md-3">
                    <input type="text" id="myInput" class="form-control" placeholder="Search">
                </div>
                <div class="col-md-9 text-right" >
                    <a href="{{ route('addNotice') }}" class="btn btn-info">
                        <i class="fa-solid fa-plus"></i> Add New Notice
                    </a>
                </div>
            </div>
            <br> -->
            <div class="row">
                <div class="col-md-3">
                    <input type="text" id="myInput" class="form-control" placeholder="Search">
                </div>
                <div class="col-md-9 text-right" >
                    <a href="{{ route('addNotice') }}" class="btn btn-info">
                        {{-- <i class="fa-solid fa-plus"></i>  --}}
                        Add New Notice
                    </a>
                </div>
            </div>
            <br>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">SN</th>
                        <th scope="col">Notice</th>
                        <th scope="col">Notice Name</th>
                        <th scope="col">Notice Details</th>
                        <th scope="col">Status</th>
                        <th scope="col" >Action</th>
                      </tr>
                    </thead>
                    <tbody id="dataTable">

                        @foreach ($notice as $i=>$notice)

                        <tr>
                            <td>{{$notice->id }}</td>
                            <td>{{$notice->notice}}</td>
                            <td>{{$notice->name}}</td>
                            <td>{!! $notice->description !!}</td>
                            <td> <a href="{{ url('updateNoticeStatus') }}/{{ $notice->id }}" type="submit" class="btn btn-info">{{ $notice->status == "deactive" ? 'Deactive' : 'Active' }}</a></td>
                            <td> <a href="{{ url('editNotice') }}/{{ $notice->id }}" class="btn text-info">
                                <i class="icon ion-compose tx-28"></i>
                            </a>
                                <a href="{{ url('deleteNotice') }}/{{ $notice->id }}" class="btn text-danger bg-white">
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/alfrcr/paginathing/dist/paginathing.min.js"></script>

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
@endsection
