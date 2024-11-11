<style>
    @media screen and (min-width:1199px) {
        .testimonial-title-border {
            position: relative;
        }
    }

    .testimonial-user-img {
        border-radius: 50% !important;
        object-position: center !important;
        padding: 3px;
        background-color: var(--primary_background);
    }

    @media screen and (max-width:767px) {
        .testimonial-user-img {
            width: 8em !important;
            height: 8em !important;

        }
    }

    @media screen and (max-width:991px) {
        .testimonial-user-img {
            width: 10em !important;
            height: 10em !important;
        }
    }

    @media screen and (min-width:992px) {
        .testimonial-user-img {
            width: 13em !important;
            height: 13em !important;
        }
    }

    .testimonial-cards.slick-slide {
        margin: 0 20px !important;
        text-align: center !important;
    }

    .testimonial-single-card {
        background-color: #f2f8f19e;
        border-radius: 10px;
        box-shadow: 0 2px 5px -3px rgba(54, 54, 54, 0.5);
        /* height: 575px; */
        /* overflow: auto; */
        /* position: relative; */
    }

    .testimonial-content {
        position: relative;
        height: 250px;
        overflow-y: auto !important;
    }

    .testimonial-content::-webkit-scrollbar {
        width: 3px;
    }

    .testimonial-content::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .testimonial-content::-webkit-scrollbar-thumb {
        background-color: #ddd;
        border-radius: 10px;
    }

    .testimonial-content .more-text {
        display: none;
        color: #333;
    }

    .see-more-btn-container {
        background-color: #f2f8f19e;
        border-radius: 0 0 10px 10px;
        text-align: center;
        padding: 0.5rem;
    }

    .see-more-btn {
        background-color: transparent;
        border: none;
        color: var(--secondary_background);
        cursor: pointer;
        font-size: 1rem;
        font-family: 'DM Sans', sans-serif;
    }
</style>
<link rel="stylesheet" href="{{ asset('frontend/ckeditor5-rendered.css') }}">

<section style="margin-top: 5rem">
    <div class="section-background py-4">
        <div class="container row mx-auto">
            <div class="col-12">
                <p class="mb-0 text-center" style="font-family: 'DM Sans', sans-serif;font-size:3rem;font-weight:600;">
                    Testimonials
                </p>
            </div>
        </div>
    
        <div class="container">
            <div class="col-12 mt-3">
                <p class="text-center fw-bold"
                    style="color:var(--primary_background); font-family: 'DM Sans', sans-serif;font-size:1.5rem;font-weight:500;">
                    What Our Partners Are Saying
                </p>
                <div class="row testimonial-cards-partners slick-slider">
                    @foreach ($testimonials_partner as $testimonial)
                        <div class="d-lg-flex flex-lg-column col-md-6 col-lg-4 justify-content-center p-2">
                            <div class="testimonial-single-card bg-white p-3">
                                <div class="d-flex justify-content-center">
                                    <img class="testimonial-user-img"
                                        src="{{ $testimonial->image_show ?? asset('frontend/images/New-Rectangle-2.webp') }}"
                                        alt="" style="border-radius:10px;">
                                </div>
    
                                <div style="height: 70px">
                                    <p class="mb-0 fw-bold mt-2 text-center"
                                        style="font-size: 1.25rem; font-family: 'DM Sans', sans-serif !important;">
                                        {{ $testimonial->name }}
                                    </p>
                                    <p class="mb-0 text-center"
                                        style="font-size: 0.9rem; font-family: 'DM Sans', sans-serif;">
                                        {{ $testimonial->designation }}
                                    </p>
                                </div>
    
                                <div class="my-2 mt-3">
                                    <img src="{{ asset('frontend/images/left-quotes-sign.png') }}" alt=""
                                        style="width:1rem">
                                </div>
                                <div class="testimonial-content">
                                    @php
                                        $comment = strip_tags($testimonial->comment);
                                    @endphp
                                    <p class="mb-0 ckeditor5-rendered testimonial-comment"
                                        data-full-comment="{{ $comment }}">
                                        {{-- {{ strlen($comment) > 250 ? substr($comment, 0, 250) . '...' : $comment }} --}}
                                        {!! $comment !!}
                                    </p>
                                </div>
                            </div>
    
                            {{-- <div class="see-more-btn-container">
                                @if (strlen($comment) > 250)
                                    <a href="javascript:void(0)" class="see-more-btn">See More</a>
                                @else
                                    <a href="javascript:void(0)" class="see-more-btn">&nbsp;</a>
                                @endif
                            </div> --}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="section-background py-2">
        <div class="container">
            <div class="col-12 mt-5">
                <p class="text-center fw-bold"
                    style="color:var(--primary_background); font-family: 'DM Sans', sans-serif;font-size:1.5rem;font-weight:500;">
                    What Our Learners Are Saying
                </p>
            </div>
            <div class="container">
                <div class="row testimonial-cards-learners slick-slider">
                    @foreach ($testimonials_learner as $testimonial)
                        <div class="d-lg-flex flex-lg-column col-md-6 col-lg-4 justify-content-center p-2">
                            <div class="testimonial-single-card bg-white p-3">
                                <div class="d-flex justify-content-center">
                                    <img class="testimonial-user-img"
                                        src="{{ $testimonial->image_show ?? asset('frontend/images/New-Rectangle-2.webp') }}"
                                        alt="" style="border-radius:10px;">
                                </div>
    
                                <div style="height: 70px">
                                    <p class="mb-0 fw-bold mt-2 text-center"
                                        style="font-size: 1.25rem; font-family: 'DM Sans', sans-serif !important;">
                                        {{ $testimonial->name }}
                                    </p>
                                    <p class="mb-0 text-center"
                                        style="font-size: 0.9rem; font-family: 'DM Sans', sans-serif;">
                                        {{ $testimonial->designation }}
                                    </p>
                                </div>
    
                                <div class="my-2 mt-3">
                                    <img src="{{ asset('frontend/images/left-quotes-sign.png') }}" alt=""
                                        style="width:1rem">
                                </div>
                                <div class="testimonial-content">
                                    @php
                                        $comment = $testimonial->comment;
                                    @endphp
                                    <p class="mb-0 ckeditor5-rendered testimonial-comment"
                                        data-full-comment="{{ $comment }}">
                                        {{-- {!! strlen($comment) > 250 ? substr($comment, 0, 250) . '...' : $comment !!} --}}
                                        {!! $comment !!}
                                    </p>
                                </div>
                            </div>
    
                            {{-- <div class="see-more-btn-container">
                                @if (strlen($comment) > 250)
                                    <a href="javascript:void(0)" class="see-more-btn">See More</a>
                                @else
                                    <a href="javascript:void(0)" class="see-more-btn">&nbsp;</a>
                                @endif
                            </div> --}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.see-more-btn');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const card = this.closest('.flex-lg-column');
                const testimonialCard = card.querySelector('.testimonial-single-card');
                const content = card.querySelector('.testimonial-content');
                const commentArea = card.querySelector('.testimonial-comment');
                const fullComment = commentArea.dataset.fullComment;
                const truncatedComment = fullComment.length > 250 ? fullComment.substring(0,
                    250) + '...' : fullComment;
                const isExpanded = card.classList.contains('expanded');

                if (isExpanded) {
                    card.classList.remove('expanded');
                    testimonialCard.style.height = '422px';
                    content.style.height = '145px';
                    commentArea.innerHTML = truncatedComment;
                    this.textContent = 'See More';
                } else {
                    card.classList.add('expanded');
                    testimonialCard.style.height = 'auto';
                    content.style.height = 'auto';
                    commentArea.innerHTML = fullComment;
                    this.textContent = 'See Less';
                }
            });
        });
    });
</script> --}}
