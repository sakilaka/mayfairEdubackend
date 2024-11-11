<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | All Partner</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
                            All Partner
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.consultant.create') }}" class="btn btn-primary btn-fw">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                Add Partner</a>
                        </nav>
                    </div>
                    <div class="row card">
                        <div class="col-sm-12 card-body table-responsive">
                            <table id="order-listing" class="table table-striped dataTable no-footer" role="grid" aria-describedby="order-listing_info">
                                <thead>
                                    <tr role="row">
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Continent</th>
                                        <th>Passport</th>
                                        <th>Level (star)</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($consultants as $consultant)
                                        @php
                                            $star = optional($partners->firstWhere('partner.id', $consultant->id))['star'] ?? 0;
                                        @endphp
                                        <tr role="row" class="odd">
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ $consultant->image_show }}" alt="{{ $consultant->name }}" width="40px" height="40px">&nbsp;&nbsp;
                                                {{ $consultant->name }}
                                            </td>
                                            <td>{{ $consultant->mobile }}</td>
                                            <td>{{ $consultant->email }}</td>
                                            <td>{{ $consultant->continents?->name }}</td>
                                            <td
                                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">
                                                <span data-toggle="tooltip" data-placement="left"
                                                    data-original-title="{{ $consultant->passport ?? '' }}">
                                                    @if ($consultant->passport)
                                                        <p class="my-2">
                                                            <a href="{{ asset('upload/users/passport/' . $consultant->passport) }}"
                                                                target="_blank">
                                                                View File
                                                            </a>
                                                        </p>
                                                    @else
                                                        <p class="my-2">No file uploaded.</p>
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                @if ($consultant->star > 0)
                                                    @for ($i = 0; $i < $consultant->star; $i++)
                                                        <i class="fa fa-star text-warning"></i> 
                                                    @endfor
                                                @else
                                                    Beginner
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($consultant->status == 1)
                                                    <a href="{{ route('admin.consultant.status', $consultant->id) }}">
                                                        <span class="badge badge-success">Active</span>
                                                    </a>
                                                @elseif($consultant->status == 0)
                                                    <a href="{{ route('admin.consultant.status', $consultant->id) }}">
                                                        <span class="badge badge-danger">Inactive</span>
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <a href="{{ route('admin.consultant.edit', $consultant->id) }}" class="btn text-primary">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </a>
                                                <input type="hidden" value="{{ $consultant->id }}">
                                                <a data-toggle="modal" data-target="#delete_modal_box" class="btn text-primary delete-item">
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

                {{-- Item delete modal --}}
                <div id="delete_modal_box" class="modal fade delete-modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <img src="{{ asset('backend/assets/images/warning.png') }}" alt=""
                                    width="50" height="46">
                                <h5 class="mt-3 mb-4">Are you sure want to delete this?</h5>
                                <div class="m-t-20 flex">
                                    <form action="{{ route('admin.consultant.delete') }}" method="POST" id="deleteForm">
                                        @csrf
                                        <input type="hidden" name="consultant_id" id="modal_item_id" value="">
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
