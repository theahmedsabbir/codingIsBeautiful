@extends('frontend.master')

@section('title')
    Add New Post
@endsection

@push('page-css')
    <link href="{{ asset('backend/lib/summernote/summernote-bs4.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('frontend/js/ckeditor-mod.js') }}" rel="stylesheet"> --}}

    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
    <style>
        .ck-powered-by-balloon {
            display: 'none'
        }
    </style> --}}
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
                            <div class="col-10 col-md-10 col-lg-10 col-xl-10 mx-auto no-pd">

                                <div class="form">
                                    <div class="card newp">
                                        <div class="card-body">

                                            <div class=" image_group">
                                                <label class="btn imageInput" for="imageInput" id="imageInputLabel">Add a
                                                    cover image</label>
                                                <input type="file" class="image-input" style="visibility: hidden;"
                                                    id="imageInput" name="image" accept="image/*"
                                                    onchange="displayFileNameAndPreview()">

                                                <div id="previewContainer" class="mt-3" style="display: none;">
                                                    <img id="previewImage" src="#" alt="Preview">
                                                </div>
                                            </div>

                                            <div class=" title_group">
                                                <!-- <input type="text" class="title_input" name="image"
                                                                                                                                            placeholder="New Post Title Here..." required> -->

                                                <textarea type="text" class="title_input" name="image" required placeholder="New Post Title Here..."
                                                    oninput="autoResize(this)"></textarea>
                                            </div>

                                            <div class=" category_group">
                                                <label for="category_id">Select Category</label>
                                                <select name="category_id" id="" class="form-control mt-2">
                                                    @foreach (App\Models\Category::orderBy('priority', 'asc')->get() as $category)
                                                        <option>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="tag_group">
                                                <label for="tag_ids">Select Tags</label>
                                                <select name="tag_ids" id="" class="form-control mt-2" multiple>
                                                    @foreach (App\Models\Tag::orderBy('priority', 'asc')->get() as $tag)
                                                        <option>{{ $tag->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            @include('frontend.includes.test')
                                            {{-- 
                                            <div class="body_group">
                                                <textarea name="body" id="" cols="30" rows="5" class="form-control"
                                                    placeholder="Write your content here..." oninput="autoResize(this)"></textarea>
                                            </div> --}}

                                            {{-- <div id="editor">
                                                <p>This is some sample content.</p>
                                            </div> --}}

                                            {{-- <textarea id="summernote"></textarea> --}}

                                        </div>
                                    </div>


                                    <button class="btn btn-primary post_submit" type="submit">Post</button>
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
    {{-- <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script> --}}


    <script type="text/javascript" src="{{ asset('frontend/js/popper.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>

    {{-- summernote --}}

    <script src="{{ asset('backend/lib/summernote/summernote-bs4.min.js') }}"></script>
    <script>
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
    </script>
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

    <script>
        function autoResize(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';
        }
    </script>
@endpush
