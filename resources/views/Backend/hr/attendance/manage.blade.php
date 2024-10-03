@extends('Backend.layouts.layouts')
@section('title', 'Attendance Manage')

@section('main_contain')
    <div class="br-mainpanel">
        <div class="br-section-wrapper">
            <div class="text-center mb-4">
                <h1 class="">Manage All Employee Attendances</h1>
                <br>
            </div>
            <!-- <div class="container" style="box-shadow: 0 0 2px gray;border-top:4px solid gray;margin-top:30px;"> -->
            <div class="row my-4 ">
                <div class="col-md-3 col-lg-3 col-sm-3 float-left">

                    <!-- start modal inTime -->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#inTimeModal">
                        In
                    </button>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#outTimeModal">
                        Out
                    </button>
                </div>
                <div class="col-md-9 col-lg-9 col-sm-9 float-right">
                    <!-- <h1>jkhyfdkjgtr</h1> -->
                    <!-- <form method="POST" action="" enctype="multipart/form-data" style="float: right;">
                            @csrf -->
                        <div class="row">


                            <div class="col-sm-2">
                                <label for="">Department *</label>
                                <select class="form-control form-control-sm" id="deptID3" name="deptID" required>
                                    <option>-- Select One --</option>
                                    @foreach ($departments as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-sm-2">
                                <label for="">Designation *</label>
                                <select class="form-control form-control-sm" id="desigID3" name="desigID" required>
                                    <option>-- Select One --</option>
                                </select>
                            </div>

                            <div class="col-sm-2">
                                <label for="">Employee ID*</label>
                                <select class="form-control form-control-sm" id="empID3" name="empID" required>
                                    <option>-- Select One --</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label for="">From Date *</label>
                                <input type="date" class="form-control form-control-sm" id="min" name="min" data-date-format="DD MMMM YYYY" value="">                                    </div>
                            <div class="col-sm-2">
                                <label for="">To Date *</label>
                                <!-- <input type="date" class=" form-control form-control-sm" name="tDate" required>                                     -->
                                <input type="date" class="form-control form-control-sm" id="max" name="max" data-date-format="DD MMMM YYYY" required>
                            </div>
                            <div class="col-sm-1">
                                <button class="btn btn-sm btn-danger mt-4" id="getData">
                                    Search
                                </button>
                            </div>
                        </div>
                    <!-- </form> -->
                </div>

            </div>

                        <!-- <br/><br/>  <br/><br/>  -->


            <div class="row">
                <div class="col-md-3">
                    <input type="text" id="myInput" class="form-control" placeholder="Search">
                </div>
                <!-- <div class="col-md-9 text-right">
                    <a href="/addEmployee" class="btn btn-info">
                        <i class="fa-solid fa-plus"></i> Add Employee
                    </a>
                </div> -->
            </div>


            <table class="table" id="myTable">
                <thead>
                  <tr>

                    <th>SN.</th>
                    <th>Duty Date</th>
                    <th>Shift</th>
                    <th>Time-in</th>
                    <th>Time-out</th>
                    <th>Working Time</th>
                    <th>Late</th>
                    <th>Overtime</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody class="refarel_table">

                        @foreach($attendances as $key=>$attendance)
                            <tr class="{{$attendance->id}}">
                                <td>{{$key+1}}</td>
                                <td>{{$attendance->dutyDate}}</td>
                                <td>{{$attendance->shiftName}}</td>
                                <td>{{date("d-m-Y g:i a",strtotime($attendance->inTime))}}</td>
                                <td>{{date("d-m-Y g:i a",strtotime($attendance->outTime))}}</td>
                                <td>
                                    @php echo intval($attendance->workingMiniute/60).' h : '.intval($attendance->workingMiniute%60).' min'@endphp
                                </td>
                                <td>
                                    @php echo intval($attendance->lateMiniute/60).' h : '.intval($attendance->lateMiniute%60).' min'@endphp
                                </td>
                                <td>
                                     @php echo intval($attendance->overtimeMiniute/60).' h : '.intval($attendance->overtimeMiniute%60).' min'@endphp</td>
                                <td>{{$attendance->status}}</td>
                                <td>
                                    <a title="Delete" href="{{route('deleteAttendance',$attendance->id)}}" id="delete" data-token="{{csrf_token()}}" data-id="{{$attendance->id}}"><i class="fas fa-trash-alt text-danger
                                          "></i></a>
                                </td>
                            </tr>
                           @endforeach
                </tbody>
            </table>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="inTimeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#01303f;max-height: 50px;">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:white;line-height:18px;">In Time</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;line-height:18px;">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row row-card-one">
                                <div class="col-sm-12">
                                    <form method="POST" action="{{ url('attendanceStoreIn') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label for="">Department *</label>
                                                <select class="form-control form-control-sm" id="deptID" name="deptID" required>
                                                    <!-- <option>-- Select One --</option>
                                                    <option value="22">ACCOUNTS</option>
                                                    <option value="21">HR DEPARTMENT</option>
                                                    <option value="20">MARKETING</option>
                                                    <option value="19">DiGITAL MARKETING</option>
                                                    <option value="18">SEO MARKETING</option>
                                                    <option value="17">Video Editor</option>
                                                    <option value="16">Web Development Laravel</option>
                                                    <option value="15">Web Development Java</option>
                                                    <option value="14">Ui/UX Design</option>
                                                    <option value="13">Front End Development</option>
                                                    <option value="12">Software Development</option>
                                                    <option value="9">Apps Development Flutter</option>
                                                    <option value="8">Mern Stack Development</option>
                                                    <option value="5">Theme Development</option>
                                                    <option value="1">Game Development</option> -->
                                                        <option value="" disabled selected>-- Select One --</option>
                                                        @foreach ($departments as $dept)
                                                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="">Designation *</label>
                                                <select class="form-control form-control-sm" id="desigID" name="desigID" required>
                                                    <!-- <option>-- wait --</option>                                          -->
                                                    {{-- <option>-- Select One --</option>
                                                    <!-- @foreach ($desgName as $dept)
                                                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                                    @endforeach --> --}}
                                                </select>
                                            </div>

                                            <div class="col-sm-3">
                                                <label for="">Employee ID*</label>
                                                <select class="form-control form-control-sm" id="empID" name="empID" required>
                                                    <!-- <option>-- wait --</option>                                       -->
                                                    {{-- <option>-- Select One --</option>
                                                        <!-- @foreach ($employee as $dept)
                                                        <option value="{{ $dept->id }}">{{ $dept->employee_id }}</option>
                                                        @endforeach --> --}}
                                                </select>
                                            </div>

                                            <div class="col-sm-3">
                                                <label for="">Duty Date *</label>
                                                <input type="date" class=" form-control form-control-sm" id="dutyDate" name="dutyDate" autocomplete="off" required>
                                            </div>
                                        </div>
                                        </br>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label for="">Shift *</label>
                                                <select class="form-control form-control-sm" id="shiftID" name="shiftID" required>
                                                    <option>-- Select One --</option>
                                                        @foreach ($shifts as $shift)
                                                        <option value="{{ $shift->id }}">{{ $shift->shiftName }}</option>
                                                        @endforeach
                                                </select>
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="">In Time *</label>
                                                <input type="datetime-local" class=" form-control form-control-sm" id="inTime" name="inTime" autocomplete="off" required>
                                            </div>


                                            <div class="col-sm-3">
                                                <button class="btn btn-sm btn-primary mt-4 ">
                                                    <i class="fa fa-save pr-2"></i>Save
                                                </button>
                                            </div>
                                        </div>
                                        <!-- </div> -->
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
        <!-- end modal outTime -->
        <!-- start modal inTime -->
        <!-- Modal -->
        <div class="modal fade" id="outTimeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#01303f;max-height: 50px;">
                        <h5 class="modal-title" id="exampleModalLabel" style="color:white;line-height:18px;">Out Time</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;line-height:18px;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row row-card-one">
                                <div class="col-sm-12">
                                    <form method="POST" action="{{ url('attendanceStoreOut') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label for="">Department *</label>
                                                <select class="form-control form-control-sm" id="deptID2" name="deptID" required>
                                                    <!-- <option>-- Select One --</option>
                                                    <option value="22">ACCOUNTS</option>
                                                    <option value="21">HR DEPARTMENT</option>
                                                    <option value="20">MARKETING</option>
                                                    <option value="19">DiGITAL MARKETING</option>
                                                    <option value="18">SEO MARKETING</option>
                                                    <option value="17">Video Editor</option>
                                                    <option value="16">Web Development Laravel</option>
                                                    <option value="15">Web Development Java</option>
                                                    <option value="14">Ui/UX Design</option>
                                                    <option value="13">Front End Development</option>
                                                    <option value="12">Software Development</option>
                                                    <option value="9">Apps Development Flutter</option>
                                                    <option value="8">Mern Stack Development</option>
                                                    <option value="5">Theme Development</option>
                                                    <option value="1">Game Development</option> -->
                                                    <option value="" disabled selected>-- Select One --</option>
                                                        @foreach ($departments as $dept)
                                                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="">Designation *</label>
                                                <select class="form-control form-control-sm" id="desigID2" name="desigID" required>
                                                    <!-- <option>-- wait --</option>                                          -->
                                                    {{-- <option>-- Select One --</option>
                                                    <!-- @foreach ($desgName as $dept)
                                                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                                    @endforeach --> --}}
                                                </select>
                                            </div>

                                            <div class="col-sm-3">
                                                <label for="">Employee ID *</label>
                                                <select class="form-control form-control-sm" id="empID2" name="empID" required>
                                                    <!-- <option>-- wait --</option>                                          -->
                                                    {{-- <option>-- Select One --</option>
                                                        <!-- @foreach ($employee as $dept)
                                                        <option value="{{ $dept->id }}">{{ $dept->employee_id }}</option>
                                                        @endforeach --> --}}
                                                </select>
                                            </div>

                                            <div class="col-sm-3">
                                                <label for="">Duty Date *</label>
                                            <input type="date" class=" form-control form-control-sm" id="dutyDate2" name="dutyDate" autocomplete="off" required>
                                            </div>
                                        </div>
                                        </br>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="">Out Time *</label>
                                                <input type="datetime-local" class=" form-control form-control-sm" id="outTime" name="outTime" autocomplete="off" required>
                                            </div>


                                            <div class="col-sm-4">
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
        <!-- end modal outTime -->
        <br/><br/>  <br/><br/>
        <!-- Main Content Area End -->
    </div>


@endsection
@section('script')
<script>

  $("#inTime").change(function()
    {
      calLoan();
    }
  );

  $("#outTime").change(function()
    {
      calLoan();
    }
  );

  $("#duration").change(function()
    {
      calLoan();
    }
  );

  function calLoan()
  {
    if($("#lamout").val() == "")
    {
      return false;
    }
    else if($("#outTime").val() == "")
    {
      return false;
    }
    else if($("#irate").val() == "")
    {
      return false;
    }
    else{
          var totalamount = 0;
          totalamount = (Number($("#lamout").val()) * Number($("#irate").val())/100) * Number($("#duration").val()) + Number($("#lamout").val())
          $("#tamout").val(totalamount.toFixed(2));
        }
  }

  $("#inTime").change(function()
    {
      if($("#outTime").val()=="")
      {
        return false;
      }
      var a = Number($("#outTime").val());
      var CurrentDate = new Date($("#inTime").val());
      CurrentDate.setMonth(CurrentDate.getMonth() + a);

      $("#workingTime").val(CurrentDate.toISOString().split('T')[0]);
    }
  );

  $(document).on('change', '#deptID3', function(){
    var deptID = $(this).val();
    console.log(deptID);
      $.ajax({
        url: "{{ url('getDesigName') }}",
        method: "POST",
        dataType: "JSON",
        data: {
          "_token": "{{ csrf_token() }}",
          "deptID": deptID
        },
        success: function (response) {
            console.log(response);
            var option = '';
            option += '<option value="" disabled selected>-- Select One --</option>';
            $.each(response, function (index, value) {
                option += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            $('#desigID3').empty().append(option);
        }
      });
    });

    $(document).on('change', '#desigID3', function(){
    var desigID = $(this).val();
    console.log(desigID);
    $.ajax({
        url: '{{ url("getEmployeeId") }}',
        method: "POST",
        dataType: "JSON",
        data: {
          "_token": "{{ csrf_token() }}",
          "desigID": desigID
        },
        success: function (response) {
            console.log(response);
            var option = '';
            option += '<option value="" disabled selected>-- Select One --</option>';
            $.each(response, function (index, value) {
                option += '<option value="' + value.id + '">' + value.employee_id + '</option>';
            });
            $('#empID3').empty().append(option);
        }
      });
    });




    $(document).on('change', '#deptID2', function(){
    var deptID = $(this).val();
    console.log(deptID);
      $.ajax({
        url: '{{ url("getDesigName2") }}',
        method: "POST",
        dataType: "JSON",
        data: {
          "_token": "{{ csrf_token() }}",
          "deptID": deptID
        },
        success: function (response) {
            console.log(response);
            var option = '';
            option += '<option value="" disabled selected>-- Select One --</option>';
            $.each(response, function (index, value) {
                option += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            $('#desigID2').empty().append(option);
        }
      });
    });

    $(document).on('change', '#desigID2', function(){
    var desigID = $(this).val();
    console.log(desigID);
    $.ajax({
        url: '{{ url("getEmployeeId2") }}',
        method: "POST",
        dataType: "JSON",
        data: {
          "_token": "{{ csrf_token() }}",
          "desigID": desigID
        },
        success: function (response) {
            console.log(response);
            var option = '';
            option += '<option value="" disabled selected>-- Select One --</option>';
            $.each(response, function (index, value) {
                option += '<option value="' + value.id + '">' + value.employee_id + '</option>';
            });
            $('#empID2').empty().append(option);
        }
      });
    });




    $(document).on('change', '#deptID', function(){
    var deptID = $(this).val();
    console.log(deptID);
      $.ajax({
        url: '{{ url("getDesigName1") }}',
        method: "POST",
        dataType: "JSON",
        data: {
          "_token": "{{ csrf_token() }}",
          "deptID": deptID
        },
        success: function (response) {
            console.log(response);
            var option = '';
            option += '<option value="" disabled selected>-- Select One --</option>';
            $.each(response, function (index, value) {
                option += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            $('#desigID').empty().append(option);
        }
      });
    });

    $(document).on('change', '#desigID', function(){
    var desigID = $(this).val();
    console.log(desigID);
    $.ajax({
        url: '{{ url("getEmployeeId1") }}',
        method: "POST",
        dataType: "JSON",
        data: {
          "_token": "{{ csrf_token() }}",
          "desigID": desigID
        },
        success: function (response) {
            console.log(response);
            var option = '';
            option += '<option value="" disabled selected>-- Select One --</option>';
            $.each(response, function (index, value) {
                option += '<option value="' + value.id + '">' + value.employee_id + '</option>';
            });
            $('#empID').empty().append(option);
        }
      });
    });

</script>


<script>
    $('#getData').on('click' , function(){
        var min = $('#min').val();
        var max = $('#max').val();

        $.ajax({
            type: 'get',
            url: "{{ url('manageAttendanceSorting') }}",
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            data: {
                min:min, max:max,
            },
            success: function(response) {
                $('.refarel_table').html(response);
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
