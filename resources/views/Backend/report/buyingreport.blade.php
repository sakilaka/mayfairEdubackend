@extends('backend.welcome')

@section('title', 'Sales Report')

<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css"/>


@section('content')

<div class="br-mainpanel">

  <!-- <div class="br-pagetitle">
    <div>
      <h4>Sales Report</h4>
      <p class="mg-b-0">View Sales Report from here
      </p>
    </div>
  </div>

  <div class="p-5"> -->

    <div class="br-section-wrapper">
     
    <div class="text-center mb-4">
                    <h1 class="">Buying Report Details</h1>
                    <br>
                    </div>

  <div class="col-sm-6">
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-4 col-form-label text-dark">From</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="min" name="min" placeholder="mm/dd/yyyy">
        </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-4 col-form-label text-dark">To</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="max" name="max" placeholder="mm/dd/yyyy">
        </div>
    </div>
  </div>
  <br>

              <div class="table-responsive">
                <table id="datatable-buttons" class="table nowrap ">
                      <thead>
                          <tr>
                              <th>SN</th>
                              <th>Date</th>
                              <th>Property Type</th>
                              <th>Package Name</th>
                              <th>Package Price</th>
                              <th>Buyer Name</th>
                              <th>Agent Name</th>
                              <th>Tax</th>
                              <th>Location</th>
                          </tr>
                      </thead>
                      <tbody class="refarel_table">
                          {{-- @php
                              $classTeachers = DB::table('class_wise_teacher')->get();
                              $teachers = DB::table('teacher_info')->get();
                              $users = DB::table('user')->get();
                          @endphp
                          @foreach ($teachers as $item)
                              <tr>
                                  <td>{{ $item ->id}}</td>
                                  <td>
                                      @foreach ($users as $user)
                                          @if ($user->id == $item->userid)
                                              {{ $user->name }}
                                          @endif
                                      @endforeach
                                  </td>
                                  <td>{{ $item->sub}}</td>
                                  <td> --}}
                                      {{-- @foreach ($classTeachers as $classTeacher)
                                          @if ($classTeacher->teacher_id == $item->id)
                                              {{ $classTeacher->subject_id}}
                                          @endif
                                      @endforeach --}}
                                      {{-- {{ $item->exp }}
                                  </td>
                                  <td>{{ $item->edu_deg }}</td>

                              </tr> --}}
                          {{-- @endforeach --}}
                      </tbody>
                  </table>
              </div>
          </div>
      <!-- </div> -->
  </div>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script>
  $(document).ready(function() {
    var minDate, maxDate;
      $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
          var min = minDate.val();
          var max = maxDate.val();
          var date = new Date( data[9] );
          if (
              ( min === null && max === null ) || ( min === null && max >= date ) || ( min <= date   && max === null ) || ( min <= date   && max >= date )
          ) {
              return true;
          }
          return false;
        }
      );
    minDate = new DateTime($('#min'), {
        format: 'YYYY-MM-DD'
    });
    maxDate = new DateTime($('#max'), {
        format: 'YYYY-MM-DD'
    });
    var table = $('#datatable-buttons').DataTable({
      "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        //debugger;
        var index = iDisplayIndexFull + 1;
        $("td:first", nRow).html(index);
        return nRow;
      },
    });
    table.buttons().container().appendTo($('#exp_buttons'))
    //Date Filter
    $('#min, #max').on('change', function () {
        table.draw();
    });
  });

</script>

@stop
