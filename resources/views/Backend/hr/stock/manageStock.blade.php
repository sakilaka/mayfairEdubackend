@extends('Backend.layouts.layouts')

@section('title', 'Manage Stock')

@section('main_contain')
    <div class="br-mainpanel">
        <div class="br-section-wrapper">
                <div class="text-center mb-4">
                    <h1 class="">Manage Stock</h1>
                    <br>
                </div>
                <div class="row">
                <div class="col-md-3">
                    <input type="text" id="myInput" class="form-control" placeholder="Search">
                </div>
                <!-- <div class="col-md-9 text-right" >
                    <a href="#" class="btn btn-info">
                        <i class="fa-solid fa-plus"></i> Add New Stock
                    </a>
                </div> -->
            </div>
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">SN</th>
                    <th scope="col">Owner Name</th>
                    <th scope="col">Agent Name</th>
                    <th scope="col">Package Title</th>
                    <th scope="col">Comission</th>
                    <th scope="col">Down Payment</th>
                    <th scope="col">View Package</th>
                    </tr>
                </thead>
                <tbody id="dataTable">
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
                                @foreach ($packageList as $pklst)
                                    @if ($pklst->packageId == $pkin->id)
                                        {{ $pklst->comission }}
                                    @endif
                                @endforeach
                            </td>

                            <td>
                                {{ $pkin->min_down_payment }}
                            </td>
                            <td>
                                <center>
                                    <a href="/viewSinglePackage/{{ $pkin->id }}"><i class="fa-duotone fa-eye btn btn-sm btn-info"></i></a>
                                </center>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/alfrcr/paginathing/dist/paginathing.min.js"></script>

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
@stop
