@foreach ($blogs as $blog)
							
						
<div class="col-xl-4 col-md-6" >
    <!--Start Course Card-->
    <div class="course-card rounded bg-white position-relative overflow-hidden shadow-none border">
        <!--Start Course Image-->
        <a href="{{ route('frontend.blog_details', $blog->id) }}" class="course-card_img d-block pt-4 px-4">
            <img src="{{ $blog->image_show }}" class="img-fluid rounded-2 w-100" alt="">
        </a>
        <!--End Course Image-->
        <!--Start Course Card Body-->
        <div class="course-card_body bg-prussian-blue p-4 position-relative m-0 rounded-0 bg-white">
            <!--Start Course Title-->
            <div class="badge px-0 mb-2">
                <a href="" class="fs-14 text-dark-cerulean" style="color: #fff;">{{ $blog->b_category->name ?? '' }}|</a> <a href="blog-topic/index.html" class="fs-14 text-dark-cerulean"></a>
            </div>
            <h3 class="course-card__course--title text-capitalize fs-6">
                <a href="{{ route('frontend.blog_details', $blog->id) }}" class=" text-decoration-none text_ellipse blog_title" style="color: var(--text_color)"> {{ $blog->title }}</a>
            </h3>
            <!--End Course Title-->
            <!--Start Course instructor-->
            <div class="course-card__instructor mb-3">
                <div class="course-card__instructor--name text-black-50 text-uppercase fw-medium fs-13 text_ellipse2" style="color: var(--text_color)">{!! $blog->description !!}</div>
            </div>
            <!--End Course instructor-->
            <div class="row">
                <div class="col-md-8">
                    <div class="avatar d-flex align-items-center">
                        <div class="avatar-img blog me-2" style="color: var(--text_color)">
                            By
                        </div>
                        <div class="fs-15 fw-semi-bold text-dark-cerulean" style="color: #fff;">
                            {{ $blog->author }}
                        <!--  -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end project-card_icon w-100">
                        <div class="me-3" id="blog_like" style="color: var(--text_color)">
                            <i class="me-1 far fa-heart"></i>
                            {{ $blog->likers->count() }}</div>
                        <div class="" style="color: var(--text_color)"><i class="me-1 far fa-eye"></i>{{ $blog->views }}</div>
                    </div>
                </div>
            </div>
            <!--Start Course Hints-->
        </div>
        <!--End Course Card Body-->
    </div>
    <!--End Course Card-->
</div>
@endforeach