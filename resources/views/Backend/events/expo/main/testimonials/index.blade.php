<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Manage Testimonials for '{{ $expo->title }}'</title>
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
                            Manage Testimonials for '{{ $expo->title }}'
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
                                                <img src="{{ $testimonial['photo'] ?? asset('frontend/images/no-profile.jpg') }}"
                                                    alt="{{ $testimonial['name'] }}" width="75" height="75"
                                                    class="rounded-circle">
                                                &nbsp;
                                                {{ $testimonial['name'] }}
                                            </td>
                                            <td>
                                                {{ $testimonial['designation'] }}
                                            </td>

                                            <td class="text-right">
                                                <a href="{{ route('admin.expo.testimonial.manage', ['expo_id' => $expo->unique_id, 'testimonial_key' => $key]) }}"
                                                    class="btn text-primary" data-toggle="tooltip"
                                                    data-title="Edit Testimonial">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </a>

                                                <a href="{{ route('admin.expo.testimonial.delete', ['expo_id' => $expo->unique_id, 'testimonial_key' => $key]) }}"
                                                    data-toggle="tooltip"
                                                    data-title="Delete Testimonial" class="btn text-primary delete-item">
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
