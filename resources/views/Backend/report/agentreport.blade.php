@extends('backend.welcome')

@section('title', 'Agent Report')

    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css"/>


@section('content')

<div class="br-mainpanel">

  <!-- <div class="br-pagetitle">
    <div>
      <h4>Agent Report</h4>
      <p class="mg-b-0">View Agent Report from here
      </p>
    </div>
  </div> -->

  <!-- <div class="p-5"> -->

    <div class="br-section-wrapper">

    <div class="text-center mb-4">
                    <h1 class="">Agent Report</h1>
                    <br>
    </div>

      <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="staticEmail" class="text-dark">From</label>
                <div class="col-sm-8 p-0">
                    <input type="date" class="form-control" id="min" name="min" data-date-format="DD MMMM YYYY">
                </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
                <label for="staticEmail" class="text-dark">To</label>
                <div class="col-sm-8 p-0">
                    <input type="date" class="form-control" id="max" name="max" data-date-format="DD MMMM YYYY">
                </div>
            </div>
          </div>

          <div class="col-md-2">
                <button class="btn btn-info mt-4" id="getData">Get Data</button>
          </div>
      </div>

              <div class="table-responsive">



                <table id="datatable1" class="table nowrap ">
                      <thead>
                          <tr>
                              <th>SN</th>
                              <th>Agent Name</th>
                              <th>Mail</th>
                              <th>Phone</th>
                              <th>Sale's</th>
                              <th>List's</th>
                          </tr>
                      </thead>
                      <tbody class="refarel_table">
                        @foreach ($user as $i=>$usr)
                            @php
                                $agN = 0;
                                $cltlist = 0;
                            @endphp
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $usr->name }}</td>
                                <td>{{ $usr->email }}</td>
                                <td>{{ $usr->phone }}</td>
                                <td>
                                    @foreach ($cart as $ct)
                                        @if ($usr->id == $ct->agent_id)
                                            @php
                                                $agN++;
                                            @endphp
                                        @endif
                                    @endforeach

                                    {{ $agN }}
                                </td>

                                <td>
                                    @foreach ($packagelisting as $pkl)
                                        @if ($pkl->agentId == $usr->id)
                                            @php
                                                $cltlist++;
                                            @endphp
                                        @endif
                                    @endforeach

                                    {{ $cltlist }}
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      <!-- </div> -->
  </div>



@stop
