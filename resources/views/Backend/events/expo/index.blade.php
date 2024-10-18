<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | All Expo</title>
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
                            All Expo
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.expo.create') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                Add Expo</a>
                        </nav>
                    </div>

                    <div class="row card">
                        <div class="col-sm-12 card-body table-responsive">
                            <table id="order-listing" class="table table-striped dataTable no-footer" role="grid"
                                aria-describedby="order-listing_info">
                                <thead>
                                    <tr role="row">
                                        <th>SL</th>
                                        <th>Title</th>
                                        <th>Place</th>
                                        <th>Date & Time</th>
                                        <th>Exhibitors</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expos as $expo)
                                        @php
                                            $universities = $expo->universities();
                                            $universityNames = $universities->pluck('name')->toArray();
                                            $fullUniversityNames = implode(', ', $universityNames);
                                            $truncatedUniversityNames = Illuminate\Support\Str::limit(
                                                $fullUniversityNames,
                                                80,
                                            );
                                        @endphp

                                        <tr role="row" class="odd">
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ route('expo.details', ['id' => $expo->unique_id]) }}"
                                                    target="_blank" style="color: var(--primary_background)"
                                                    data-toggle="tooltip" data-original-title="{{ $expo->title }}"
                                                    data-placement="top">
                                                    {{ Illuminate\Support\Str::limit($expo->title, 40, '...') }}
                                                </a>
                                            </td>
                                            <td>
                                                @php
                                                    $place = json_decode($expo->place, true) ?? [];
                                                @endphp

                                                @if ($place)
                                                    <span data-toggle="tooltip"
                                                        data-original-title="{{ $place['venue'] . ' in ' . $place['address'] }}"
                                                        data-placement="top">
                                                        {{ Illuminate\Support\Str::limit($place['venue'], 30, '...') }}
                                                        in
                                                        {{ Illuminate\Support\Str::limit($place['address'], 30, '...') }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $datetime = json_decode($expo->datetime, true) ?? [];
                                                @endphp

                                                @if ($datetime)
                                                    {{ $datetime['date'] }};
                                                    {{ $datetime['time_from'] . ' to ' . $datetime['time_to'] }}
                                                @endif
                                            </td>
                                            <td data-toggle="tooltip" data-placement="top"
                                                data-original-title="{{ $fullUniversityNames }}">
                                                {{ $truncatedUniversityNames }}
                                            </td>

                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                            class="fa fa-ellipsis-v text-primary"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <div class="d-flex justify-content-end">
                                                            <a href="{{ route('admin.expo.exhibitors.testimonial.index', ['expo_id' => $expo->unique_id]) }}"
                                                                class="btn text-primary" data-toggle="tooltip"
                                                                data-title="Manage Testimonials">
                                                                <i class="fa fa-comments" aria-hidden="true"></i>
                                                            </a>
                                                            <a href="{{ route('admin.expo.edit', $expo->id) }}"
                                                                class="btn text-primary" data-toggle="tooltip"
                                                                data-title="Edit Expo">
                                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                            </a>

                                                            <input type="hidden" value="{{ $expo->id }}">
                                                            <a data-toggle="modal" data-target="#delete_modal_box"
                                                                class="btn text-primary delete-item">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Item delete modal --}}
                <div id="delete_modal_box" class="modal fade delete-modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <img src="{{ asset('backend/assets/images/warning.png') }}" alt=""
                                    width="50" height="46">
                                <h5 class="mt-3 mb-4">Are you sure want to delete this?</h5>
                                <div class="m-t-20 flex">
                                    <form action="{{ route('admin.expo.delete') }}" method="POST" id="deleteForm">
                                        @csrf
                                        <input type="hidden" name="expo_id" id="modal_item_id" value="">
                                    </form>
                                    <div class="mt-3">
                                        <a href="#" class="btn btn-success" data-dismiss="modal">Cancel</a>
                                        <a class="btn btn-danger"
                                            onclick="document.getElementById('deleteForm').submit()">Confirm</a>
                                    </div>
                                </div>
                            </div>
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
