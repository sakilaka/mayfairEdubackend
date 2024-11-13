<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Partner Wise Appliction List</title>
</head>

<body>
    <div class="container-scroller">
        @include('Backend.components.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('Backend.components.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            Partner Wise Appliction List
                        </h3>
                    </div>

                    <div class="row card">
                        <div class="col-sm-12 card-body table-responsive">
                            <table id="order-listing" class="table table-striped dataTable no-footer" role="grid"
                                aria-describedby="order-listing_info">
                                <thead>
                                    <tr role="row">
                                        <th class="text-left" style="max-width: 50px;">SL</th>
                                        <th>Partner</th>
                                        {{-- <th class="text-right">Total Students</th> --}}
                                        <th class="text-right">All Applications</th>
                                        <th class="text-right">Levels</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                        <tr role="row" class="{{ $key % 2 == 0 ? 'even' : 'odd' }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item['partner']->name }}</td>
                                            {{-- <td class="text-right">
                                                @if ($item['total_students'] != 0)
                                                    {{ $item['total_students'] }}
                                                    <a href="{{ route('admin.student_list_partner_wise', ['partner_id' => $item['partner']->id]) }}"
                                                        class="ml-4 mr-2 badge badge-primary">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                @else
                                                    <span class="badge badge-primary"
                                                        style="background-color: transparent; border-color: transparent;">
                                                        <i class="fa fa-eye" aria-hidden="true"
                                                            style="color: transparent;"></i>
                                                    </span>
                                                @endif
                                            </td> --}}
                                            <td class="text-right">
                                                @if ($item['total_applications'] != 0)
                                                    {{ $item['total_applications'] }}
                                                    <a href="{{ route('admin.appliction_list_partner_wise', ['partner_id' => $item['partner']->id]) }}"
                                                        class="ml-4 mr-2 badge badge-primary">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                @else
                                                    <span class="badge badge-primary"
                                                        style="background-color: transparent; border-color: transparent;">
                                                        <i class="fa fa-eye" aria-hidden="true"
                                                            style="color: transparent;"></i>
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-right">{{ $item['levels'] == null ? 'Beginner' : $item['levels'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @include('Backend.components.footer')
            </div>
        </div>
    </div>

    @include('Backend.components.script')
</body>

</html>
