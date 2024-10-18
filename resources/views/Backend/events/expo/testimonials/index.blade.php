<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Manage Testimonials of '{{ $expo->title }}'</title>
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
                            Manage Testimonials of '{{ $expo->title }}'
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.expo.testimonial.manage', ['expo_id' => $expo->unique_id]) }}"
                                class="btn btn-primary btn-fw">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                Add Testimonial</a>
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
                                        $testimonials = json_decode($expo->testimonials, true) ?? [];
                                    @endphp
                                    
                                    @foreach ($testimonials ?? [] as $key => $testimonial)
                                        <tr role="row" class="odd">
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $testimonial['name'] }}
                                            </td>
                                            <td>
                                                {{ $testimonial['designation'] }}
                                            </td>

                                            <td class="text-right">
                                                <a href="{{ route('admin.expo.testimonial.manage', ['expo_id' => $expo->unique_id, 'testimonial_key' => $key]) }}"
                                                    class="btn text-primary" data-toggle="tooltip"
                                                    data-title="Edit Testimonials">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </a>

                                                <input type="hidden" value="{{ $key }}">
                                                <a data-toggle="modal" data-target="#delete_modal_box"
                                                    class="btn text-primary delete-item">
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
