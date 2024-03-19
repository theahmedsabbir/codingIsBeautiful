@extends('backend.master')

@section('title')
Post
@endsection

@section('content')
@if ($data['page'] == 'index')
<div class="br-pagetitle">
    <i class="icon ion-android-list"></i>
    <div>
        <h4>Manage Posts</h4>
        <p class="mg-b-0">
            <a href="{{ url('admin/dashboard') }}">Dashboard</a>
            / Post /
        </p>
    </div>
</div>
<div class="br-pagebody">
    <div class="br-section-wrapper">
        @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="table-wrapper table-responsive">
            <table id="datatable3" class="table display nowrap">
                <thead>
                    <tr>
                        <th class="text-capitalize">#</th>
                        <th class="text-capitalize">name</th>
                        <th class="text-capitalize">slug</th>
                        <th class="text-capitalize">priority</th>
                        <th class="text-capitalize">status</th>
                        <th class="text-capitalize">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['posts']->sortBy('priority') as $post)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $post->name }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{!! $post->priority !!}</td>
                        <td>{{ $post->status }}</td>
                        <td>
                            <a href="{{ url('/admin/post/edit/' . $post->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <a href="{{ url('/admin/post/delete/' . $post->id) }}"
                                onclick="return confirm('Are you sure delete this information.')"
                                class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- table-wrapper -->

    </div><!-- br-section-wrapper -->
</div><!-- br-pagebody -->
@endif
@if ($data['page'] == 'create')
{{-- @dd($data['posts']) --}}
<div class="br-pagetitle">
    <i class="icon ion-android-list"></i>
    <div>
        <h4>Create Post</h4>
        <p class="mg-b-0">
            <a href="{{ url('admin/dashboard') }}">Dashboard</a>
            / <a href="{{ url('admin/post/manage') }}">Post</a> / Create
        </p>
    </div>
</div>
<div class="br-pagebody">
    <div class="br-section-wrapper">
        @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <form action="{{ url('admin/post/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <textarea id="summernote"></textarea>

                    <div class="form-group">
                        <label for="" class="text-capitalize">title</label>
                        <input type="text" name="title" value="" class="form-control" placeholder="Post title" required>
                        @if ($errors->has('title'))
                        <div class="text-danger">{{ $errors->first('title') }}</div>
                        @endif
                    </div>

                    {{--
                    <div class="form-group">
                        <label for="">Priority</label>
                        <input type="number" name="priority" class="form-control" placeholder="1" required>
                        @if ($errors->has('priority'))
                        <div class="text-danger">{{ $errors->first('priority') }}</div>
                        @endif
                    </div> --}}

                    <div class="form-group">
                        <label for="">Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="active">Active</option>
                            <option value="disabled">Disabled</option>
                        </select>
                        @if ($errors->has('status'))
                        <div class="text-danger">{{ $errors->first('status') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-teal mt-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- br-section-wrapper -->
</div>
@endif
@if ($data['page'] == 'edit')
<div class="br-pagetitle">
    <i class="icon ion-android-list"></i>
    <div>
        <h4>Edit Post</h4>
        <p class="mg-b-0">
            <a href="{{ url('admin/dashboard') }}">Dashboard</a>
            / <a href="{{ url('admin/post/manage') }}">Post</a> / Edit
        </p>
    </div>
</div>
<div class="br-pagebody">
    <div class="br-section-wrapper">
        @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <form action="{{ url('admin/post/update/' . $data['post']->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" value="{{ $data['post']->name }}" class="form-control"
                            placeholder="Post name" required>
                        @if ($errors->has('name'))
                        <div class="text-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="">Priority</label>
                        <input type="number" name="priority" class="form-control" value="{{ $data['post']->priority }}"
                            placeholder="1" required>
                        @if ($errors->has('priority'))
                        <div class="text-danger">{{ $errors->first('priority') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="active" {{ $data['post']->status == 'active' ? 'selected' : '' }}>
                                Active</option>
                            <option value="disabled" {{ $data['post']->status == 'disabled' ? 'selected' : '' }}>
                                Disabled</option>
                        </select>
                        @if ($errors->has('status'))
                        <div class="text-danger">{{ $errors->first('status') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-teal mt-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- br-section-wrapper -->
</div>
@endif
@endsection