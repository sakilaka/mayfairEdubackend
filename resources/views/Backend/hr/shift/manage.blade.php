@extends('Backend.layouts.layouts')

@section('title', 'Employee')

@section('main_contain')

<div class="br-mainpanel">
  <div class="br-section-wrapper">
        <div class="text-center mb-4">
            <h1 class="">Manage All Employee's Shift Informations</h1>
            <br>
        </div>

                <div class="col-md-12 col-lg-12 col-sm-12">
                    	<!-- start modal for insert -->
                        <!-- Button trigger modal -->
                        <div class="row">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalStore">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>


                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                  <div class="modal-header" style="background-color:#01303f;max-height: 50px;">
                                    <h5 class="modal-title" id="exampleModalLabel" style="color:white;line-height:18px;">Shift Management</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true" style="color: white;line-height:18px;">×</span>
                                    </button>
                                  </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="row row-card-one">
                                                <div class="col-sm-12">
                                                   <!-- form here -->
                                                    <form method="POST" action="{{ url('shiftManageStore') }}" enctype="multipart/form-data">
                                                        @csrf
                                                            <div class="form-row">
                                                            <input type="hidden" value="0" name="id" required="">
                                                            <div class="col-sm-3">
                                                                <label for="">Shift Name*</label>
                                                                <input type="text" class=" form-control form-control-sm" name="shiftName" autocomplete="off" required="">
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <label for="">Start Time*</label>
                                                                <input type="time" class=" form-control form-control-sm" name="startTime" autocomplete="off" required="">
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <label for="">End Time*</label>
                                                                <input type="time" class=" form-control form-control-sm" name="endTime" autocomplete="off" required="">
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <button class="btn btn-sm btn-primary mt-4 ">
                                                                    <i class="fa fa-save pr-2"></i>Save
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modal for insert-->

                        <!-- start modal for edit -->
                        <!-- Button trigger modal -->
                        <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                          <i class="fas fa-plus"></i>
                        </button> -->

                            <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                  <div class="modal-header" style="background-color:#01303f;max-height: 50px;">
                                    <h5 class="modal-title" id="exampleModalLabel" style="color:white;line-height:18px;">Shift Management</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true" style="color: white;line-height:18px;">×</span>
                                    </button>
                                  </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="row row-card-one">
                                                <div class="col-sm-12">
                                                   <!-- form here -->

                                                    <form method="POST" action="{{ url('updateShift') }}/{id}" enctype="multipart/form-data">
                                                          @csrf
                                                            <input type="hidden" value="0" name="id" id="shiftID" required="">
                                                           <div class="row">
                                                               <div class="col-sm-3">
                                                                <label for="">Shift Name*</label>
                                                                <input type="text" class=" form-control form-control-sm" id="shiftName" name="shiftName" autocomplete="off" required="">
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <label for="">Start Time*</label>
                                                                <input type="time" class=" form-control form-control-sm" id="startTime" name="startTime" autocomplete="off" required="" >
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <label for="">End Time*</label>
                                                                <input type="time" class=" form-control form-control-sm" id="endTime" name="endTime" autocomplete="off" required="" >
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <button class="btn btn-sm btn-primary mt-4 ">
                                                                    <i class="fa fa-save pr-2"></i>Save
                                                                </button>
                                                            </div>
                                                           </div>
                                                        </div>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modal for edit -->

                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="dataTable_length">
                            <!-- <label>Show
                                <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries
                            </label> -->
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div id="dataTable_filter" class="dataTables_filter">
                            <label>Search:
                                <input type="search" id="myInput" class="form-control form-control-sm" placeholder="" aria-controls="dataTable">
                            </label>
                        </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="dataTable" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="dataTable_info">
                            <thead>
                                <tr role="row">
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="SN.: activate to sort column descending" style="width: 24px;">SN.</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Shift Name: activate to sort column ascending" style="width: 60px;">Shift Name</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start Time: activate to sort column ascending" style="width: 55px;">Start Time</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="End Time: activate to sort column ascending" style="width: 51px;">End Time</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 53px;">Actions</th>
                                </tr>
                            </thead>

                            <tbody id="dataTable">
                                @foreach ($shift as $i=>$data)
                                <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $data->shiftName }}</td>
                                <td>{{ $data->startTime }}</td>
                                <td>{{ $data->endTime }}</td>

                                    <td>
                                    <span id="shiftEdit" data-id="{{ $data->id }}" data-toggle="modal" data-target="#exampleModal" class="btn text-info">
                                        <i class="icon ion-compose tx-28"></i>
                                    </span>

                                        <a title="Delete" href="{{ url('DeleteShift') }}/{{ $data->id }}" id="delete" data-id="2" class="btn text-danger bg-white">
                                            <i class="icon ion-trash-a tx-28"></i>
                                    </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>

                        </div>
                    </div>

  </div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/alfrcr/paginathing/dist/paginathing.min.js"></script>
<script>
    $(document).on('click', '#shiftEdit', function(){
        var id = $(this).data('id');
        // console.log(id);
        $.ajax({
            url: '{{ url("editShift") }}/'+id,
            type: 'GET',
            dataType: 'json',
            success: function(data){
                $('#shiftID').val(data.id);
                $('#shiftName').val(data.shiftName);
                $('#startTime').val(data.startTime);
                $('#endTime').val(data.endTime);
            }
        });
    });
</script>


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
