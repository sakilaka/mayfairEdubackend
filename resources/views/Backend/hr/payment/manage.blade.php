@extends('Backend.layouts.layouts')

@section('title', 'Manage Paymnent Range')


@section('main_contain')

<div class="br-mainpanel">

          <div class="br-section-wrapper">

                <div class="text-center mb-4">
                    <h1 class="">Manage Paymnent Range</h1>
                    <br>
                </div>

              <!-- Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#01303f;max-height: 50px;">
                            <h5 class="modal-title" id="addModalLabel" style="color:white;line-height:18px;">Payment Range</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="color: white;line-height:18px;">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row row-card-one">
                                    <div class="col-sm-12">

                                        <!-- form here -->
                                        <form method="POST" action="{{route('storePaymentRange')}}">
                                            @csrf
                                            <div class="form-row">
                                                <input type="hidden" value="0" name="id" required="">
                                                <div class="col-sm-3">
                                                    <label for="">Department *</label>
                                                    <select class="form-control form-control-sm" id="deptID2"
                                                    name="department_id" required="">
                                                        <option>-- Select One --</option>



                                                        @foreach($departments as $deparment)
                                                            <option value="{{$deparment->id}}">{{$deparment->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="">Designation *</label>
                                                    <select class="form-control form-control-sm" id="desigID2" name="designation_id" required=""><option>-- Select One --</option></select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="">Minimum Payment *</label>
                                                    <input type="number" step="any" class=" form-control form-control-sm" name="min" autocomplete="off" required="">
                                                </div>

                                                <div class="col-sm-3">
                                                    <label for="">Maximum Payment *</label>
                                                    <input type="number" step="any" class=" form-control form-control-sm" name="max" autocomplete="off" required="">
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
                    </div>
                </div>
            </div>
              <input type="text" placeholder="Search Data" id="myInput">

              <a href="{{ route('addPayroll') }}" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i></a>

                  <br>
                  <br>
                <table class="table table-striped" id="dataTable">
                  <thead>
                    <tr>
                      <th scope="col">SL</th>
                      <th scope="col">Department</th>
                      <th scope="col">Designation</th>
                      <th scope="col">Minimum Amount</th>
                      <th scope="col">Maximum Amount</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="dataTable" >

                      <tr>
                      @foreach ($viewAll as $i=>$data)
                        <tr>
                          <th scope="row">{{ $i+1 }}</th>

                          <td>{{$data->department?->name}}</td>
                          <td>{{$data->designation?->name}}</td>
                          <td>BDT {{$data->min}}</td>
                          <td>BDT {{$data->max}}</td>
                          <td>
                              <a class="btn text-info" href="{{ url('editPayroll') }}/{{ $data->id }}" data-toggle="modal" data-target="#editModal_{{$data->id}}"
                              >
                                  <i class="icon ion-compose tx-28"></i>
                              </a>
                              <a href="/deletePaymentRange/{{ $data->id }}" class="btn text-danger bg-white">
                                  <i class="icon ion-trash-a tx-28"></i>
                              </a>
                          </td>
                        </tr>
                      @endforeach

                      </tr>

                  </tbody>
                </table>
          </div>
      </div>


      <!-- Edit  -->

      @forEach($viewAll as $p)

<!-- edit  Modal -->
<div class="modal fade" id="editModal_{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#01303f;max-height: 50px;">
        <h5 class="modal-title" id="addModalLabel" style="color:white;line-height:18px;">Update Payment Range</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color: white;line-height:18px;">×</span>
        </button>
        </div>
      <div class="modal-body">
            <div class="container-fluid">
                <div class="row row-card-one">
                    <div class="col-sm-12">

                        <!-- form here -->
                        <form method="POST" action="{{route('updatePaymentRange',$p->id)}}">
                            @csrf
                            <div class="form-row">
                                <input type="hidden" value="0" name="id" required="">
                                <div class="col-sm-3">
                                    <label for="">Department *</label>
                                    <select class="form-control form-control-sm" id="edit_deptID2" name="department_id" required="">
                                        <option>-- Select One --</option>
                                        @foreach($departments as $deparment)

                                        <option value="{{$deparment->id}}"
                                        @if($deparment->id == $p->department_id)
                                        selected
                                        @endif
                                        >{{$deparment->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="">Designation *</label>
                                    <select class="form-control form-control-sm" id="edit_desigID2" name="designation_id" required="">
                                       <option>-- Select One --</option>
                                        @foreach($designations as $d)
                                        <option value="{{$d->id}}"
                                        @if($d->id == $p->designation_id)
                                        selected
                                        @endif
                                        >{{$d->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="">Minimum Payment *</label>
                                    <input type="number" step="any" class=" form-control form-control-sm" name="min" autocomplete="off" required="" value="{{$p->min}}">
                                </div>

                                <div class="col-sm-3">
                                    <label for="">Maximum Payment *</label>
                                    <input type="number" step="any" value="{{$p->max}}" class=" form-control form-control-sm" name="max" autocomplete="off" required="">
                                </div>
                                <div class="col-sm-3">
                                    <button class="btn btn-sm btn-primary mt-4 ">
                                        <i class="fa fa-save pr-2"></i>Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
      @endforeach
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




<script>

    $('body').on("change",'#edit_deptID2',function(){
        let id = $(this).val()

        let url = "{{ url('designations-by-dept') }}/" + id
         axios.get(url)
            .then(res => {
                let html = '';
                html += '<option value="">-- Select One --</option>'
                res.data.forEach(element => {
                    html += "<option value=" + element.id + ">" + element.name + "</option>"
                });
                 $('#edit_desigID2').html(html);
            });
    })

</script>
<script>

    $('body').on("change",'#deptID2',function(){
        let id = $(this).val()

        let url = "{{ url('designations-by-dept') }}/" + id
         axios.get(url)
            .then(res => {
                let html = '';
                html += '<option value="">-- Select One --</option>'
                res.data.forEach(element => {
                    html += "<option value=" + element.id + ">" + element.name + "</option>"
                });
                 $('#desigID2').html(html);
            });
    })

</script>
@endsection
