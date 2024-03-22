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
                                <h4 class="ds_label mb-3">posts</h4>
                                <div class="card ds_single_post mb-1">

                                    <div class="">
                                        <div class="row">
                                            <div class="col-12 col-lg-8">
                                                <a class="ds_post_link" href="">Lorem ipsum dolor sit amet,
                                                    consectetur adipisicing elit.
                                                    Labore, fuga!</a>
                                                <span href="" class="badge badge-warning">Draft</span>
                                            </div>
                                            <div class="col-12 col-lg-4 text-left text-lg-right">
                                                <div class="ds_action_buttons">
                                                    <a href="" class="btn btn-sm text-primary">Edit</a>
                                                    <a href="" class="btn btn-sm text-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
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

    {{-- submit form after changing status  --}}
    <script>
        function submitForm(isDraft) {
            let form = document.getElementById('postForm');

            let action = '{{ route('new.store') }}';

            if (isDraft) action += '?status=draft'

            form.action = action

            let submitButton = document.getElementById('submitButton')

            submitButton.click();
        }
    </script>
@endpush
