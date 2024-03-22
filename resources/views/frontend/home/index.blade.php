@extends('frontend.master')

@section('title')
    Home
@endsection

@push('style')
@endpush

@section('content')
    <div class="wrapper">

        <!-- header nav -->
        @include('frontend.includes.nav')

        <main>
            <div class="main-section">
                <div class="container">
                    <div class="main-section-data">
                        <div class="row">

                            <!-- left-sidebar -->
                            <div class="col-md-3 col-lg-2 col-xl-2 d-none d-md-block pd-left-none no-pd">
                                @include('frontend.includes.leftSidebar')
                            </div>

                            <!-- mid content -->
                            <div class="col-md-9 col-lg-10 col-xl-7 no-pd">
                                <div class="main-ws-sec">
                                    <div class="posts-section">

                                        <!-- single post with image -->
                                        @foreach (App\Models\Post::where('status', 'active')->get() as $post)
                                            {{-- @dd($post) --}}
                                            <div class="post-bar p-0">

                                                <div class="post_image_p"
                                                    style="background: url('{{ asset('posts/' . $post->cover_image) }}') center center/cover no-repeat; ">
                                                </div>
                                                <div class="row post_content_row">
                                                    <div class="col-xl-12 p-0">
                                                    </div>
                                                    <div class="col-xl-1 p-0">
                                                        <div class="post_topbar">
                                                            <div class="usy-dt">
                                                                <img src="{{ asset('frontend') }}/images/resources/us-pic.png"
                                                                    alt="">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-xl-11 px-0 px-xl-2">

                                                        <div class="job_descp">
                                                            <div class="usy-name">
                                                                <h3>Sabbir Ahmed</h3>
                                                                <span><img src="{{ asset('frontend') }}/images/clock.png"
                                                                        alt="">3 min
                                                                    ago</span>
                                                            </div>
                                                            <div class="post_details">
                                                                <a href="{{ url('/sp') }}">
                                                                    <h3>{{ $post->title }}</h3>
                                                                </a>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                    Aliquam
                                                                    luctus hendrerit metus, ut ullamcorper quam finibus at.
                                                                    Etiam id
                                                                    magna sit amet... <a href="#" title="">view
                                                                        more</a></p>
                                                                <ul class="skill-tags">
                                                                    <li><a href="#" title="">#HTML</a></li>
                                                                    <li><a href="#" title="">#PHP</a></li>
                                                                    <li><a href="#" title="">#CSS</a></li>
                                                                    <li><a href="#" title="">#Javascript</a>
                                                                    </li>
                                                                    <li><a href="#" title="">#Wordpress</a>
                                                                    </li>
                                                                </ul>
                                                                <ul class="skill-tags post_attributes pr-3">
                                                                    <li>
                                                                        <a href="#"><i class="fas fa-eye"></i> 50
                                                                            Views</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#"><i class="fas fa-heart"></i> 20
                                                                            Reactions</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#"><i class="fas fa-comment-alt"></i>
                                                                            14
                                                                            Comments</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" title=""><i
                                                                                class="fa fa-share-square-o"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach



                                        <div class="post-bar p-0">

                                            <div class="post_image_p"
                                                style="background: url('https://images.pexels.com/photos/2236674/pexels-photo-2236674.jpeg') center center/cover no-repeat; ">
                                            </div>
                                            <div class="row post_content_row">
                                                <div class="col-xl-12 p-0">
                                                </div>
                                                <div class="col-xl-1 p-0">
                                                    <div class="post_topbar">
                                                        <div class="usy-dt">
                                                            <img src="{{ asset('frontend') }}/images/resources/us-pic.png"
                                                                alt="">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xl-11 px-0 px-xl-2">

                                                    <div class="job_descp">
                                                        <div class="usy-name">
                                                            <h3>Sabbir Ahmed</h3>
                                                            <span><img src="{{ asset('frontend') }}/images/clock.png"
                                                                    alt="">3 min
                                                                ago</span>
                                                        </div>
                                                        <div class="post_details">
                                                            <a href="{{ url('/sp') }}">
                                                                <h3>Python libraries you need to know in 2024</h3>
                                                            </a>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Aliquam
                                                                luctus hendrerit metus, ut ullamcorper quam finibus at.
                                                                Etiam id
                                                                magna sit amet... <a href="#" title="">view
                                                                    more</a></p>
                                                            <ul class="skill-tags">
                                                                <li><a href="#" title="">#HTML</a></li>
                                                                <li><a href="#" title="">#PHP</a></li>
                                                                <li><a href="#" title="">#CSS</a></li>
                                                                <li><a href="#" title="">#Javascript</a>
                                                                </li>
                                                                <li><a href="#" title="">#Wordpress</a>
                                                                </li>
                                                            </ul>
                                                            <ul class="skill-tags post_attributes pr-3">
                                                                <li>
                                                                    <a href="#"><i class="fas fa-eye"></i> 50
                                                                        Views</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#"><i class="fas fa-heart"></i> 20
                                                                        Reactions</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#"><i class="fas fa-comment-alt"></i>
                                                                        14
                                                                        Comments</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" title=""><i
                                                                            class="fa fa-share-square-o"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- single post with image -->
                                        <div class="post-bar p-0">
                                            <div class="row post_content_row">
                                                <div class="col-xl-12 p-0">
                                                </div>
                                                <div class="col-xl-1 p-0">
                                                    <div class="post_topbar">
                                                        <div class="usy-dt">
                                                            <img src="{{ asset('frontend') }}/images/resources/us-pic.png"
                                                                alt="">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xl-11 px-0 px-xl-2">

                                                    <div class="job_descp">
                                                        <div class="usy-name">
                                                            <h3>Sabbir Ahmed</h3>
                                                            <span><img src="{{ asset('frontend') }}/images/clock.png"
                                                                    alt="">3 min
                                                                ago</span>
                                                        </div>
                                                        <div class="post_details">
                                                            <h3>Python libraries you need to know in 2024</h3>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Aliquam
                                                                luctus hendrerit metus, ut ullamcorper quam finibus at.
                                                                Etiam id
                                                                magna sit amet... <a href="#" title="">view
                                                                    more</a></p>
                                                            <ul class="skill-tags">
                                                                <li><a href="#" title="">#HTML</a></li>
                                                                <li><a href="#" title="">#PHP</a></li>
                                                                <li><a href="#" title="">#CSS</a></li>
                                                                <li><a href="#" title="">#Javascript</a>
                                                                </li>
                                                                <li><a href="#" title="">#Wordpress</a>
                                                                </li>
                                                            </ul>
                                                            <ul class="skill-tags post_attributes pr-3">
                                                                <li>
                                                                    <a href="#"><i class="fas fa-eye"></i> 50
                                                                        Views</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#"><i class="fas fa-heart"></i> 20
                                                                        Reactions</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#"><i class="fas fa-comment-alt"></i>
                                                                        14
                                                                        Comments</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" title=""><i
                                                                            class="fa fa-share-square-o"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!--posts-section end-->
                                </div><!--main-ws-sec end-->
                            </div>

                            <!-- right sidebar -->
                            <div class="col-lg-3 col-xl-3 d-none d-xl-block pd-right-none no-pd">
                                @include('frontend.includes.rightSidebar')
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
