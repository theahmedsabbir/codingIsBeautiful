@extends('frontend.master')

@section('title')
    {{ $post->slug }}
@endsection

@push('style')
@endpush

@section('content')
    <div class="wrapper single_post_page sp">

        <!-- header nav -->
        @include('frontend.includes.nav')

        <main>
            <div class="main-section">
                <div class="container">
                    <div class="main-section-data">
                        <div class="row">

                            <!-- mid content -->
                            <div class="col-md-12 col-lg-12 col-xl-9 no-pd single_post_box">


                                <!-- single post with image -->
                                <div class="pl-0 pl-sm-5">
                                    <div class="post-bar p-0">

                                        @if ($post->cover_image)
                                            <div class="post_image_p"
                                                style="background: url('{{ asset('posts/' . $post->cover_image) }}') center center/cover no-repeat; ">
                                            </div>
                                        @endif


                                        <div class="row post_content_row">
                                            <div class="col-xl-12 px-0 px-xl-2">


                                                <div class="post_topbar">
                                                    <div class="usy-dt">
                                                        <img src="{{ $post->user ? asset('avatars/' . $post->user->avatar) : '' }}"
                                                            alt="{{ $post->user->name ?? $post->slug }}">
                                                    </div>
                                                    <div class="usy-name">
                                                        <h3>{{ $post->user->name ?? '' }}</h3>
                                                        <span><img src="{{ asset('frontend') }}/images/clock.png"
                                                                alt="">{{ $post->updated_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>

                                                <div class="job_descp">
                                                    <div class="post_details">
                                                        <h3>{{ $post->title }}</h3>
                                                        <ul class="skill-tags">
                                                            @foreach ($post->tags as $tag)
                                                                <li><a href=""{{ url('tag/' . $tag->slug) }}"
                                                                        title="">#{{ $tag->name }}</a></li>
                                                            @endforeach
                                                        </ul>

                                                        <div class="post_text">{!! $post->body !!}</div>

                                                        {{-- <p class="post_text">{!! $post->body !!}</p> --}}
                                                        {{-- <p class="post_text">
                                                            Often, as developers, we write similar types of code,
                                                            falling
                                                            into a pattern that, while comfortable, can sometimes feel
                                                            mundane. <br> <br>

                                                            However, the world of JavaScript is vast, filled with
                                                            advanced features that, when discovered and used, can
                                                            transform our development work into something much more
                                                            exciting and fulfilling. <br> <br>

                                                            In this guide, we will unveil 25 advanced JavaScript
                                                            features that promise not just to reveal these hidden gems
                                                            but also to elevate your mastery of JavaScript to
                                                            unprecedented levels. <br> <br>

                                                            Let’s embark on this journey of discovery together,
                                                            integrating JavaScript’s advanced capabilities into our
                                                            coding repertoire to create more efficient, elegant, and
                                                            powerful applications. It’s time to infuse our development
                                                            tasks with a newfound sense of fun and creativity.
                                                            Often, as developers, we write similar types of code,
                                                            falling
                                                            into a pattern that, while comfortable, can sometimes feel
                                                            mundane. <br> <br>

                                                            However, the world of JavaScript is vast, filled with
                                                            advanced features that, when discovered and used, can
                                                            transform our development work into something much more
                                                            exciting and fulfilling.

                                                            In this guide, we will unveil 25 advanced JavaScript
                                                            features that promise not just to reveal these hidden gems
                                                            but also to elevate your mastery of JavaScript to
                                                            unprecedented levels.

                                                            Let’s embark on this journey of discovery together,
                                                            integrating JavaScript’s advanced capabilities into our
                                                            coding repertoire to create more efficient, elegant, and
                                                            powerful applications. It’s time to infuse our development
                                                            tasks with a newfound sense of fun and creativity.
                                                            Often, as developers, we write similar types of code,
                                                            falling
                                                            into a pattern that, while comfortable, can sometimes feel
                                                            mundane.
                                                        </p> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- post_attributes -->
                                <div class="single_post_attributes d-none d-sm-block">
                                    <ul class="reactions">
                                        <li>
                                            <a href="">
                                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                <span>10</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <i class="fa fa-comment-o" aria-hidden="true"></i>
                                                <span>10</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                <span>10</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <i class="fa fa-share-square-o" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- post_attributes mobile -->
                                <div class="single_post_attributes single_post_attributes_m d-block d-sm-none">
                                    <ul class="reactions">
                                        <li>
                                            <a href="">
                                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                <span>10</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <i class="fa fa-comment-o" aria-hidden="true"></i>
                                                <span>10</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                <span>10</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <i class="fa fa-share-square-o" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- comment block -->
                                <div class="pl-0 pl-sm-5 comments">

                                    <!-- comment input -->
                                    <div class="post-bar p-0">

                                        <div class="row post_content_row">
                                            <div class="col-xl-12 p-0">
                                                <h1 class="comment_head">Comments</h1>
                                            </div>


                                            <div class="col-1 p-0">
                                                <div class="post_topbar">
                                                    <div class="usy-dt">
                                                        <img src="{{ asset('frontend') }}/images/resources/us-pic.png"
                                                            alt="">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-11 px-0 px-xl-2">

                                                <div class="comment">
                                                    <div class="comment_user">
                                                        <h3>Sabbir Ahmed</h3>
                                                        <span><img src="{{ asset('frontend') }}/images/clock.png"
                                                                alt="">3 min ago</span>
                                                    </div>
                                                    <div class="post_details">
                                                        <form action="">
                                                            <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
                                                            <button class="btn btn-primary mt-2">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row post_content_row sc">
                                            <div class="col-1 p-0">
                                                <div class="post_topbar">
                                                    <div class="usy-dt">
                                                        <img src="{{ asset('frontend') }}/images/resources/us-pic.png"
                                                            alt="">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-11 px-0 px-xl-2">

                                                <div class="comment">
                                                    <div class="comment_user">
                                                        <h3>Sabbir Ahmed</h3>
                                                        <span><img src="{{ asset('frontend') }}/images/clock.png"
                                                                alt="">3 min ago</span>
                                                    </div>
                                                    <div class="post_details">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                            Aliquam
                                                            luctus hendrerit metus, ut ullamcorper quam finibus at.
                                                            Etiam id
                                                            magna sit animate
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row post_content_row sc">
                                            <div class="col-1 p-0">
                                                <div class="post_topbar">
                                                    <div class="usy-dt">
                                                        <img src="{{ asset('frontend') }}/images/resources/us-pic.png"
                                                            alt="">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-11 px-0 px-xl-2">

                                                <div class="comment">
                                                    <div class="comment_user">
                                                        <h3>Sabbir Ahmed</h3>
                                                        <span><img src="{{ asset('frontend') }}/images/clock.png"
                                                                alt="">3 min ago</span>
                                                    </div>
                                                    <div class="post_details">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                            Aliquam
                                                            luctus hendrerit metus, ut ullamcorper quam finibus at.
                                                            Etiam id
                                                            magna sit animate
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- right sidebar -->
                            <div class="col-lg-3 col-xl-3 d-none d-xl-block pd-right-none no-pd">
                                @include('frontend.includes.rightSidebar', [
                                    'title' => 'Related discussions',
                                ])
                                {{-- <div class="right-sidebar">
                                    <div class="widget widget-jobs">
                                        <div class="sd-title">
                                            <h3>Related discussions</h3>
                                        </div>
                                        <div class="jobs-list">
                                            <div class="job-info">
                                                <div class="job-details">
                                                    <h3>Make the OpenAI Function Calling Work Better and Cheaper with a
                                                        Two-Step Function Call 🚀</h3>
                                                    <p>1 Views</p>
                                                </div>
                                            </div>
                                            <div class="job-info">
                                                <div class="job-details">
                                                    <h3>Make the OpenAI Function Calling Work Better and Cheaper with a
                                                        Two-Step Function Call 🚀</h3>
                                                    <p>1 Views</p>
                                                </div>
                                            </div>
                                            <div class="job-info">
                                                <div class="job-details">
                                                    <h3>Make the OpenAI Function Calling Work Better and Cheaper with a
                                                        Two-Step Function Call 🚀</h3>
                                                    <p>1 Views</p>
                                                </div>
                                            </div>
                                            <div class="job-info">
                                                <div class="job-details">
                                                    <h3>Make the OpenAI Function Calling Work Better and Cheaper with a
                                                        Two-Step Function Call 🚀</h3>
                                                    <p>1 Views</p>
                                                </div>
                                            </div>
                                            <div class="job-info">
                                                <div class="job-details">
                                                    <h3>Make the OpenAI Function Calling Work Better and Cheaper with a
                                                        Two-Step Function Call 🚀</h3>
                                                    <p>1 Views</p>
                                                </div>
                                            </div>
                                        </div><!--jobs-list end-->
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div><!-- main-section-data end-->
                </div>
            </div>
        </main>

    </div>
@endsection

@push('script')
@endpush
