@foreach ($blogs as $blog)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card service-card">
            <a href="{{ route('frontend.blog_details', $blog->id) }}">
                <img src="{{ $blog->image_show }}" class="card-img-top" alt="{{ $blog->title }}">
            </a>
            <div class="card-body">
                <p class="card-subtitle text-capital text-muted">
                    {{ $blog->b_category->name ?? '' }}&nbsp;</p>
                <a href="{{ route('frontend.blog_details', $blog->id) }}" style="color: var(--btn_primary_color)">
                    <h5 class="card-title mb-2" onclick="{{ route('frontend.blog_details', $blog->id) }}">
                        {{ Illuminate\Support\Str::limit($blog->title, 50, '...') }}
                    </h5>
                </a>

                <div class="d-flex align-items-center justify-content-between">
                    <p class="text-muted">
                        {{ date('d M, Y', strtotime($blog->created_at)) }}
                    </p>
                    <p class="text-muted">
                        <i class="fa fa-eye"></i>&nbsp;

                        {{ $blog->views }}
                    </p>
                </div>

                <div class="d-flex align-items-center justify-content-end">
                    <a href="{{ route('frontend.blog_details', $blog->id) }}"
                        class="details-link d-flex align-items-center justify-content-end">
                        <span>Read More</span>
                        <svg width="16" height="16" viewBox="0 0 16 16"
                            class="duration-100 ease-in ml-2 group-hover:translate-x-2" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 0L6.59 1.41L12.17 7H0V9H12.17L6.59 14.59L8 16L16 8L8 0Z"
                                fill="var(--secondary_background)"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach
