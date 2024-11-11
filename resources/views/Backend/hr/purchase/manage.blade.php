@extends('Backend.layouts.layouts')

@section('title', 'Manage Purchase')


@section('main_contain')

<div class="br-mainpanel">

          <div class="br-section-wrapper p-2">
 <div class="">
   <div class="text-center ">
      <h2 class="text-center ">Manage Purchase</h2>
   </div>

              <div class="text-right">
                     <!-- <a href="{{ route('addPurchase') }}" class="btn btn-info btn-sm float-right">Add Purchase</a> -->
              </div>
              </div>

              <input type="text" placeholder="Search Data" id="myInput">



                  <br>
                  <br>
                <table class="table table-striped" id="dataTable">
                  <thead>
                    <tr>
                      <th scope="col">SL</th>
                      <th scope="col">Company Name</th>
                      <th scope="col">Product Name</th>
                      <th scope="col">Status</th>

                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="dataTable" >

                      <tr>
                      @foreach ($viewAll as $i=>$data)
                        <tr>
                          <th scope="row">{{ $i+1 }}</th>
                          <td scope="row">{{$data->company_name}}</td>
                          <td scope="row">{{$data->product_name}}</td>
                          <td scope="row">{{ucwords($data->status)}}</td>
                          <td>
                            <a href="/viewPurchase/{{ $data->id }}" style="color: #d49d27; font-size:15px !important">
                                <i class="fa-duotone fa-eye btn btn-sm btn-info"></i>
                            </a>
                              <a href="/editPurchase/{{ $data->id }}" style="color: #d49d27; font-size:15px !important">
                                  <i class="fa-duotone fa-edit btn btn-sm btn-success"></i>
                              </a>
                              <a href="/deletePurchase/{{ $data->id }}" style="color: #000">
                                  <i class="fa-duotone fa-trash-can btn btn-sm btn-danger"></i>
                              </a>
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
