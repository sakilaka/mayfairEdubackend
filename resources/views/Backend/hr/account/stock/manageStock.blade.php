@extends('Backend.layouts.layouts')

@section('title', 'Manage Stock')

@section('main_contain')
    <div class="br-mainpanel">
        <div class="br-section-wrapper">
            <center>
            <h1>Available Stock Amounts</h1>
            <p class="mg-b-0">View Available Stock Details from here</p>
            </center>
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
                            <th scope="col">SN</th>
                            <th scope="col">Owner Name</th>
                            <th scope="col">Agent Name</th>
                            <th scope="col">Package Title</th>
                            <th scope="col">Min Down Payment</th>
                            <th scope="col">Comission</th>
                            <th scope="col">Listed By Agent</th>
                        </tr>
                    </thead>
                <tbody class="refarel_table">
                    @php
                        $totalDownPay = '0';
                        $totalComission = '0';
                    @endphp
                        @foreach ($package_info as $i=>$pkin)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>
                                    @foreach ($user as $usr)
                                        @if ($usr->id == $pkin->userid)
                                            {{ $usr->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($packageList as $pklst)
                                    @if ($pklst->packageId == $pkin->id)
                                            @foreach ($user as $usr)
                                                @if ($usr->id == $pklst->agentId)
                                                    {{ $usr->name }}
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    {{ $pkin->package_title }}
                                </td>
                                <td>
                                {{ $pkin->min_down_payment }}
                                @php
                                    $totalDownPay = $totalDownPay+$pkin->min_down_payment;
                                @endphp
                                </td>

                            <td>
                                @foreach ($packageList as $pklst)
                                    @if ($pklst->packageId == $pkin->id)
                                        {{ $pklst->comission }}
                                        @php
                                            $totalComission = $totalComission+$pklst->comission;
                                        @endphp
                                    @endif
                                @endforeach
                            </td>
                            <td>
                            @foreach ($packageList as $pklst)
                                @if ($pklst->packageId == $pkin->id)
                                    {{ $pklst->created_at }}
                                @endif
                            @endforeach
                            </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b>Total</b></td>
                            <td><b>{{ $totalDownPay }}</b></td>
                            <td><b>{{ $totalComission }}</b></td>
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

            $.ajax({
                type: 'get',
                url: "/manageStockSorting",
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
