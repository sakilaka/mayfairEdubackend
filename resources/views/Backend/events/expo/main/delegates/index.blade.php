<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Manage Overseas Delegates for '{{ $expo->title }}'</title>
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
                            Manage Overseas Delegates for '{{ $expo->title }}'
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.expo.delegate.manage', ['expo_id' => $expo->unique_id]) }}"
                                class="btn btn-primary btn-fw">
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                                Add Delegate</a>
                        </nav>
                    </div>

                    <div class="row card">
                        <div class="col-sm-12 card-body table-responsive">
                            <table id="order-listing" class="table table-striped dataTable no-footer" role="grid"
                                aria-describedby="order-listing_info">
                                <thead>
                                    <tr role="row">
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $delegates = json_decode($expo->delegates, true) ?? [];
                                    @endphp

                                    @foreach ($delegates ?? [] as $key => $delegate)
                                        <tr role="row" class="odd">
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ $delegate['photo'] ?? asset('frontend/images/no-profile.jpg') }}"
                                                    alt="{{ $delegate['name'] }}" width="75" height="75"
                                                    class="rounded-circle">
                                                &nbsp;
                                                {{ $delegate['name'] }}
                                            </td>
                                            <td>
                                                {{ $delegate['designation'] }}
                                            </td>

                                            <td class="text-right">
                                                <a href="{{ route('admin.expo.delegate.manage', ['expo_id' => $expo->unique_id, 'delegate_key' => $key]) }}"
                                                    class="btn text-primary" data-toggle="tooltip"
                                                    data-title="Edit Delegate">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </a>

                                                <a href="{{ route('admin.expo.delegate.delete', ['expo_id' => $expo->unique_id, 'delegate_key' => $key]) }}"
                                                    data-toggle="tooltip"
                                                    data-title="Delete Delegate" class="btn text-primary delete-item">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </td>
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
