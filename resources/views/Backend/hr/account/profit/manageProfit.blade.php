@extends('Backend.layouts.layouts')

@section('title', 'Manage Profit Amounts')

<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css"/>


@section('main_contain')

<div class="br-mainpanel">
    <div class="br-section-wrapper">
        <center>
            <div>
            <h1>Manage Profit Amounts</h1>
            <p class="mg-b-0">View Profit Amount Details from here</p>
            </div>
        </center>
      <br>
      <br>
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
                              <th>Buyer Name</th>
                              <th>Seller Name</th>
                              <th>Agent Name</th>
                              <th>Package Name</th>
                              <th>Buying Price</th>
                              <th>Comission</th>
                              <th>Profit Amount</th>
                              <th>Date</th>
                          </tr>
                      </thead>
                      <tbody class="refarel_table">

                      @php

                        $totalComission = '0';
                        $totalPrice = '0';
                        $totProfit = '0';

                      @endphp

                        @foreach ($cart as $i=>$ct)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>
                                    @foreach ($user as $usr)
                                        @if ($usr->id == $ct->user_id)
                                            {{ $usr->name }}
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    @foreach ($pkg as $pk)
                                        @if ($pk->id == $ct->package_id)
                                            @foreach ($user as $usr)
                                                @if ($pk->userid == $usr->id)
                                                    {{ $usr->name }}
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    @foreach ($user as $usr)
                                        @if ($usr->id == $ct->agent_id)
                                            {{ $usr->name }}
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    @foreach ($pkg as $pk)
                                        @if ($pk->id == $ct->package_id)
                                            {{ $pk->package_title }}
                                        @endif
                                    @endforeach
                                </td>
                                <td id="total">
                                    {{ $ct->price }}
                                    @php
                                        $totalPrice = $totalPrice+$ct->price;
                                    @endphp
                                </td>
                                <td id="commission">
                                    {{ $ct->comission }}%
                                    @php
                                        $totalComission = $totalComission+$ct->comission;
                                    @endphp
                                </td>
                                <td id="result">
                                    @php
                                        $totalPri = $ct->price * $ct->comission/100;
                                    @endphp
                                    {{ $totalPri }}
                                    @php
                                        $totProfit = $totProfit + $totalPri;
                                    @endphp
                                </td>
                                <td>
                                    {{ $ct->deal_date }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b>Total</b></td>
                            <td><b>{{ $totalPrice }}</b></td>
                            <td><b>{{ $totalComission }}</b></td>
                            <td><b>{{ $totProfit }}</b></td>
                            <td></td>
                        </tr>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>


  <script>
    $('#getData').on('click' , function(){
        var min = $('#min').val();
        var max = $('#max').val();
        // var total =  $('#min').val() + $('#max').val();

        $.ajax({
            type: 'get',
            url: "/manageProfitSorting",
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
