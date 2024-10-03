<!DOCTYPE html>
<html lang="en">

<head>
    @include('User-Backend.components.head')
    <title>{{ env('APP_NAME') }} | My Wishlist</title>
</head>

<body>
    <div class="container-scroller">
        @include('User-Backend.components.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('User-Backend.components.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            My Wishlist
                        </h3>
                    </div>

                    <div class="row card">
                        <div class="col-sm-12 card-body table-responsive">
                            <table id="order-listing" class="table dataTable-export table-striped dataTable no-footer"
                                role="grid" aria-describedby="order-listing_info">
                                <thead>
                                    <tr role="row">
                                        <th class="text-left">SL</th>
                                        <th>University</th>
                                        <th>Course Name</th>
                                        <th>Department</th>
                                        <th>Degree</th>
                                        <th class="text-center">Tuition Fee</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($saves as $save)
                                        <tr role="row" class="odd">
                                            <td class="text-left">{{ $loop->iteration }}</td>
                                            <td class="text-left" >
                                                <img src="{{ $save->course->university->image_show ?? '' }}"
                                                    style="width: 40px; height:40px" alt="">
                                            </td>
                                            <td
                                                style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 300px;">
                                                <span data-toggle="tooltip" data-placement="left"
                                                    data-original-title="{{ $save->course->name }}">
                                                    {{ $save->course->name }}
                                                </span>
                                            </td>
                                            <td>{{ @$save->course->department->name }}</td>
                                            <td>{{ @$save->course->degree->name }}</td>
                                            <td>{{ $save->course->year_fee }}</td>
                                            <td class="text-right">
                                                <a href="{{ route('frontend.course.details', $save->course->id) }}"
                                                    class="btn text-primary" data-toggle="tooltip" data-placement="top"
                                                    data-original-title="View Course Details" target="_blank">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('apply_cart', $save->course->id) }}"
                                                    class="btn text-primary" data-toggle="tooltip" data-placement="top"
                                                    data-original-title="Apply Now" target="_blank">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @include('User-Backend.components.footer')
            </div>
        </div>
    </div>

    @include('User-Backend.components.script')

</body>

</html>
