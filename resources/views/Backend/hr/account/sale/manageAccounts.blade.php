@extends('Backend.layouts.layouts')

@section('title', 'Manage Sale Amounts')

<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css"/>


@section('main_contain')

<div class="br-mainpanel">
  <div>
  <div class="br-section-wrapper">
    <center>
      <div>
        <h1>Manage Sale Amounts</h1>
        <p class="mg-b-0">View Sale Amount Details from here</p>
      </div>
    </center>
      <br>
      <br>
    <div class="row">
        <div class="col-md-5">
                <label for="staticEmail" class="text-dark">From</label>
                    <input type="date" class="form-control" id="min" name="min" data-date-format="DD MMMM YYYY" value="">
          </div>
          <div class="col-md-5">
                <label for="staticEmail" class="text-dark">To</label>
                <input type="date" class="form-control" id="max" name="max" data-date-format="DD MMMM YYYY">
          </div>
          <div class="col-md-2">
                <button class="btn btn-primary mt-4" id="getData">Get Data</button>
          </div>
          <!-- <div class="col-md-3">
                <label for="staticEmail" class="text-dark">Search</label>
                <input type="text" class="form-control" id="" name="" >
          </div> -->

      </div>
          <br>

              <div class="table-responsive">

                <table id="datatable-buttons" class="table nowrap ">
                      <thead>
                          <tr>
                              <th>SN</th>
                              <th>Buyer</th>
                              <th>Seller</th>
                              <th>Agent</th>
                              <th>Package</th>
                              <th>Down Payemnt</th>
                              <th>Comission</th>
                              <th>Buying Price</th>
                              <th>Date</th>
                          </tr>
                      </thead>
                      <tbody class="refarel_table">

                      @php
                        $totalDownPay = '0';
                        $totalComission = '0';
                        $totalPrice = '0';
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

                                <td>
                                    {{ $ct->down_payemnt }}
                                    @php
                                        $totalDownPay = $totalDownPay+$ct->down_payemnt;
                                    @endphp
                                </td>

                                <td>
                                    {{ $ct->comission }}
                                    @php
                                        $totalComission = $totalComission+$ct->comission;
                                    @endphp
                                </td>

                                <td>
                                    {{ $ct->price }}
                                    @php
                                        $totalPrice = $totalPrice+$ct->price;
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
                            <td><b>{{ $totalDownPay }}</b></td>
                            <td><b>{{ $totalComission }}</b></td>
                            <td><b>{{ $totalPrice }}</b></td>
                            <td></td>
                        </tr>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>


<script>
    $('#getData').on('click' , function(){
        var min = $('#min').val();
        var max = $('#max').val();

        $.ajax({
            type: 'get',
            url: "/manageAccountsSorting",
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
