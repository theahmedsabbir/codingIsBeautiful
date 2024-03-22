@extends('frontend.master')

@section('title')
    Add New Post
@endsection

@push('page-css')
    <!-- Link to Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="wrapper">

        <!-- header nav -->
        @include('frontend.includes.nav')

        <main class="new">
            <div class="main-section">
                <div class="container">
                    <div class="main-section-data">
                        <div class="row">

                            <!-- mid content -->
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 mx-0 mx-xl-auto no-pd">

                                <form class="form" name="postForm" id="postForm" method="post"
                                    action="{{ route('new.store') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="card newp">
                                        <div class="card-body">

                                            <div class="px-60">
                                                <div class=" image_group">
                                                    <label class="btn imageInput" for="imageInput" id="imageInputLabel">Add
                                                        a
                                                        cover image</label>
                                                    <input type="file" class="image-input" style="visibility: hidden;"
                                                        id="imageInput" name="cover_image" accept="image/*"
                                                        onchange="displayFileNameAndPreview()">

                                                    <div id="previewContainer" class="mt-3" style="display: none;">
                                                        <img id="previewImage" src="#" alt="Preview">
                                                    </div>
                                                </div>

                                                <div class=" title_group">
                                                    <textarea type="text" class="title_input" name="title" required placeholder="New Post Title Here..."
                                                        oninput="autoResize(this)" required></textarea>
                                                </div>

                                                <div class=" category_group">
                                                    <label for="category_id">Select Category</label>
                                                    <select name="category_id" id="category_id" class="form-control mt-2"
                                                        required>
                                                        <option value="" selected disabled>Select a category
                                                        </option>
                                                        @foreach (App\Models\Category::orderBy('priority', 'asc')->get() as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="tag_group">
                                                    <label for="tags">Select Tags</label>
                                                    <select name="tags[]" id="tag_ids" class="form-control mt-2 select2"
                                                        multiple>
                                                        @foreach (App\Models\Tag::orderBy('priority', 'asc')->get() as $tag)
                                                            <option>{{ $tag->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>


                                            @include('frontend.includes.textEditor')

                                        </div>
                                    </div>


                                    <button class="btn btn-primary d-none" type="submit" id="submitButton">Submit</button>
                                    <button class="btn btn-primary post_submit" onclick="submitForm()">Publish</button>
                                    <button class="btn btn-primary post_submit ml-2" onclick="submitForm(true)">Save as
                                        draft</button>
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
    <!-- Link to Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        // Initialize Select2 with tagging
        $(document).ready(function() {
            $('#category_id').select2({});
        });

        // Initialize Select2 with tagging
        $(document).ready(function() {
            $('#tag_ids').select2({
                tags: true,
                tokenSeparators: [',', ' ']
            });
        });
    </script>
    {{-- <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script> --}}


    {{-- <script type="text/javascript" src="{{ asset('frontend/js/popper.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script> --}}

    {{-- summernote --}}

    {{-- <script src="{{ asset('backend/lib/summernote/summernote-bs4.min.js') }}"></script> --}}
    {{-- <script>
        $(function() {
            'use strict';

            // Inline editor
            // var editor = new MediumEditor('.editable');

            // Summernote editor
            $('#summernote').summernote({
                height: 150,
                tooltip: false
            })
        });
    </script> --}}

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
