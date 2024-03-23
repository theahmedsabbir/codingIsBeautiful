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

        <main class="rg">
            <div class="main-section">
                <div class="container">
                    <div class="main-section-data">
                        <div class="row">

                            <!-- mid content -->
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-7 mx-0 mx-xl-auto no-pd">

                                <form class="form" name="postForm" id="postForm" method="post"
                                    action="{{ route('login') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="card ">
                                        <div class="card-body">

                                            <div class="row">
                                                {{-- logo --}}
                                                <div class="col-xl-5 mx-auto">
                                                    <div class="logo d-none d-xl-block">
                                                        <a href="{{ route('root') }}" title="" class="logo_link">
                                                            <img src="{{ asset('frontend') }}/images/logo.png"
                                                                alt="" class="d-none d-xl-block logo_img"
                                                                id="logo_img">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                {{-- other form parts --}}
                                                <div class="col-xl-12 mx-auto mt-3">
                                                    {{-- title --}}
                                                    <h3 class="register_title text-center mb-3">Login to dashboard
                                                    </h3>

                                                    {{-- email --}}
                                                    <div class="form-group">
                                                        <label for="email" class="text-capitalize mb-2">email</label>
                                                        <input type="email" name="email" required class="form-control">
                                                    </div>

                                                    {{-- password --}}
                                                    <div class="form-group">
                                                        <label for="password" class="text-capitalize mb-2">password</label>
                                                        <input type="password" name="password" required
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="buttons">

                                        <button class="btn btn-primary post_submit" type="submit">Login</button>
                                        <button class="btn btn-primary post_submit second_button">Forgot Password</button>
                                    </div>
                                </form>
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
@endpush
