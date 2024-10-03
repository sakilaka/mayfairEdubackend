@extends('Backend.layouts.layouts')

@section('title', 'Manage Service Expenses')


@section('main_contain')
    <div class="br-mainpanel">
        <div class="br-section-wrapper">
        <center>
            <h1>Manage Service Expensess</h1>
            <p class="mg-b-0">View Expenses Details from here</p>
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
                      <th scope="col">SN</th>
                      <th scope="col">Category</th>
                      <th scope="col">Sub-Category</th>
                      <th scope="col">Title</th>
                      <th scope="col">Service Expenses</th>
                      <th scope="col">Service Price</th>
                      <th scope="col">Service Created</th>
                    </tr>
                </thead>
                <tbody class="refarel_table">
                @php
                    $totalExp = '0';
                    $totalCost = '0';
                @endphp
                    @foreach ($services as $i=>$srv)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $srv->category }}</td>
                            <td>{{ $srv->sub_category }}</td>
                            <td>{{ $srv->title }}</td>
                            <td>{{ $srv->expense }}
                                    @php
                                        $totalExp = $totalExp+$srv->expense;
                                    @endphp
                            </td>
                            <td>{{ $srv->cost }}
                                    @php
                                        $totalCost = $totalCost+$srv->cost;
                                    @endphp
                            </td>
                            <td>{{ $srv->created }}</td>
                        </tr>
                    @endforeach
                    <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b>Total</b></td>
                            <td><b>{{ $totalExp }}</b></td>
                            <td><b>{{ $totalCost }}</b></td>
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
            url: "/manageExpensesSorting",
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
