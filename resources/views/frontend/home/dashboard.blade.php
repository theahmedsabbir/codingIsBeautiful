@extends('frontend.master')

@section('title')
    Add New Post
@endsection

@push('page-css')
@endpush

@section('content')
    <div class="wrapper">

        <!-- header nav -->
        @include('frontend.includes.nav')

        <main class="ds">
            <div class="main-section">
                <div class="container">
                    <div class="main-section-data">
                        <div class="row">

                            <!-- mid content -->
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mx-0 mx-xl-auto no-pd">

                                {{-- statistics here --}}

                                {{-- add post list here --}}
                                <div class="row mb-3">
                                    <div class="p-0 col-6">
                                        <h4 class="ds_label">posts</h4>
                                    </div>
                                    <div class="p-0 col-6 text-right">
                                        <a href="{{ route('new') }}" class="btn btn-primary btn_blue_highlight">Create
                                            Post</a>
                                    </div>
                                </div>
                                @foreach (Auth::user()->posts as $post)
                                    <div class="card ds_single_post mb-1">
                                        <div class="row">
                                            <div class="col-12 col-lg-8">
                                                <a class="ds_post_link"
                                                    href="{{ route('post.edit', $post->slug) }}">{{ $post->title }}</a>
                                                @if ($post->status !== 'active')
                                                    <span href=""
                                                        class="badge badge-warning text-capitalize">{{ $post->status }}</span>
                                                @endif
                                            </div>
                                            <div class="col-12 col-lg-4 text-left text-lg-right">
                                                <div class="ds_action_buttons">
                                                    <a href="{{ route('post.edit', $post->slug) }}"
                                                        class="btn btn-sm text-primary">Edit</a>
                                                    <a href="" onclick="deletePost()"
                                                        class="btn btn-sm text-danger">Delete</a>

                                                    <form action="{{ route('post.delete', $post->slug) }}" method="post"
                                                        class="d-none" id="deletePost">
                                                        @csrf
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                {{-- show a message if there is no post --}}
                                @if (Auth::user()->posts->count() === 0)
                                    <div class="row">
                                        <div class="col-12 p-0">
                                            <div class="card ds_single_post no_post mb-1">
                                                <i class="fa fa-meh-o"></i>

                                                <h5 class="mt-4">Nothing here!</h5>
                                                <h5 class="">Ready to announce your thoughts to the world?</h5>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div><!-- main-section-data end-->
                </div>
            </div>
        </main>

    </div>
@endsection

@push('page-js')
    {{-- show file name and preview --}}
    <script>
        function displayFileNameAndPreview() {
            const inputFile = document.getElementById('imageInput');
            const fileName = inputFile.files[0].name;
            const label = document.getElementById('imageInputLabel');
            label.innerHTML = fileName;

            // Display image preview
            const previewImage = document.getElementById('previewImage');
            const previewContainer = document.getElementById('previewContainer');

            const file = inputFile.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
            }

            reader.readAsDataURL(file);
        }
    </script>

    {{-- autoresize textarea --}}
    <script>
        function autoResize(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';
        }
    </script>

    {{-- prevent other buttons from form submitting --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var buttons = document.querySelectorAll('button');
            buttons.forEach(function(button) {
                if (button.getAttribute('type') !== 'submit') {
                    button.setAttribute('type', 'button');
                }
            });
        });
    </script>


    {{-- confirm before post delete --}}
    <script>
        function deletePost() {
            event.preventDefault();
            if (confirm('Are you sure?')) {
                document.getElementById('deletePost').submit()
            }
        }
    </script>
@endpush
