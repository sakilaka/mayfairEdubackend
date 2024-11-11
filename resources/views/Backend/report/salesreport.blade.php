@extends('backend.welcome')

@section('title', 'Sales Report')

<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css"/>

@section('content')

<div class="br-mainpanel">
<!-- 
  <div class="br-pagetitle">
    <div>
      <h4>Sales Report</h4>
      <p class="mg-b-0">View Sales Report from here
      </p>
    </div>
  </div>

  <div class="p-5"> -->

    <div class="br-section-wrapper">

                    <div class="text-center mb-4">
                    <h1 class="">Sales Report</h1>
                    <br>
                    </div>
    <div class="row">

        <div class="col-md-5">

            <div class="form-group">
                <label for="staticEmail" class="text-dark">From</label>
                <div class="col-sm-8 p-0">
                    <input type="date" class="form-control" id="min" name="min" data-date-format="DD MMMM YYYY" value="">
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

                <table id="datatable-buttons" class="table nowrap ">
                      <thead>
                          <tr>
                              <th>SN</th>
                              <th>Seller Name</th>
                              <th>Agent Name</th>
                              <th>Package Name</th>
                              <th>Comission</th>
                              <th>Buying Price</th>
                              <th>Sale Price</th>
                              <th>Date</th>
                          </tr>
                      </thead>
                      <tbody class="refarel_table">
                        @foreach ($list as $i=>$lst)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>
                                    @foreach ($user as $usr)
                                        @if ($usr->id == $lst->packageId)
                                            {{ $usr->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($user as $usr)
                                        @if ($usr->id == $lst->agentId)
                                            {{ $usr->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($pkg as $pk)
                                        @if ($pk->id == $lst->packageId)
                                            {{ $pk->package_title }}
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    {{ $lst->comission }}%
                                </td>

                                <td>
                                    @foreach ($pkg as $pk)
                                        @if ($pk->id == $lst->packageId)
                                            {{ $pk->price }}
                                        @endif
                                    @endforeach
                                </td>


                                <td>
                                    @foreach ($pkg as $pk)
                                        @if ($pk->id == $lst->packageId)
                                            {{ $pk->price*$lst->comission/100 + $pk->price }}
                                        @endif
                                    @endforeach
                                </td>


                                <td>
                                    {{ $lst->created_at }}
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      <!-- </div> -->
  </div>


<script>
    $('#getData').on('click' , function(){

        var min = $('#min').val();
        var max = $('#max').val();

        $.ajax({
            type: 'get',
            url: "/salesReportShorting",
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


@stop
