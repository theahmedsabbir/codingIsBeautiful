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
                                        @foreach ($posts as $post)
                                            {{-- @dd($post) --}}
                                            <div class="post-bar p-0">

                                                @if ($post->cover_image)
                                                    <a href="{{ url('/article', $post->slug) }}"
                                                        class="post_image_link d-block">
                                                        <div class="post_image_p"
                                                            style="background: url('{{ asset('posts/' . $post->cover_image) }}') center center/cover no-repeat; ">
                                                        </div>
                                                    </a>
                                                @endif
                                                <div class="row post_content_row">
                                                    <div class="col-xl-12 p-0">
                                                    </div>
                                                    <div class="col-xl-1 p-0">
                                                        <div class="post_topbar">
                                                            <div class="usy-dt">
                                                                <img src="{{ $post->user ? asset('avatars/' . $post->user->avatar) : '' }}"
                                                                    alt="{{ $post->user->name ?? $post->slug }}">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-xl-11 px-0 px-xl-2">
                                                        {{-- @dd(substr(strip_tags($post->body), 0, 100)) --}}
                                                        {{-- @dd($post->views()->get()->sum('view'))
                                                        @dd($post) --}}
                                                        <div class="job_descp">
                                                            <div class="usy-name">
                                                                <h3>{{ $post->user->name ?? '' }}</h3>
                                                                <span>
                                                                    <img src="{{ asset('frontend') }}/images/clock.png"
                                                                        alt="">{{ $post->updated_at->diffForHumans() }}
                                                                </span>
                                                            </div>
                                                            <div class="post_details">
                                                                <a href="{{ url('/article', $post->slug) }}">
                                                                    <h3>{{ $post->title }}</h3>
                                                                </a>
                                                                <p>{{ substr(strip_tags($post->body), 0, 110) }}... <a
                                                                        href="#" title="">view
                                                                        more</a></p>
                                                                <ul class="skill-tags">
                                                                    @foreach ($post->tags as $tag)
                                                                        <li><a href="{{ url('tag/' . $tag->slug) }}"
                                                                                title="">#{{ $tag->name }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                                <ul class="skill-tags post_attributes pr-3">
                                                                    <li>
                                                                        <a href="#"><i class="fas fa-eye"></i>
                                                                            {{ $post->totalViews() }}
                                                                            View</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#"><i class="fas fa-heart"></i>
                                                                            {{ $post->loves()->count() }}
                                                                            Reaction</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#"><i class="fas fa-comment-alt"></i>
                                                                            0
                                                                            Comment</a>
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
