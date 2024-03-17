@extends('backend.master')

@section('title')
    Category
@endsection

@section('content')
    @if ($data['page'] == 'index')
        <div class="br-pagetitle">
            <i class="icon ion-android-list"></i>
            <div>
                <h4>Manage Categorys</h4>
                <p class="mg-b-0">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                    / Category /
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
                                <th class="text-capitalize">icon</th>
                                <th class="text-capitalize">priority</th>
                                <th class="text-capitalize">status</th>
                                <th class="text-capitalize">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['categories']->sortBy('priority') as $category)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{!! $category->icon !!}</td>
                                    <td>{!! $category->priority !!}</td>
                                    <td>{{ $category->status }}</td>
                                    <td>
                                        <a href="{{ url('/admin/category/edit/' . $category->id) }}"
                                            class="btn btn-sm btn-info">Edit</a>
                                        <a href="{{ url('/admin/category/delete/' . $category->id) }}"
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
        {{-- @dd($data['categories']) --}}
        <div class="br-pagetitle">
            <i class="icon ion-android-list"></i>
            <div>
                <h4>Create Category</h4>
                <p class="mg-b-0">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                    / <a href="{{ url('admin/category/manage') }}">Category</a> / Create
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
                        <form action="{{ url('admin/category/store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" value="" class="form-control"
                                    placeholder="Category name" required>
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>


                            <div class="form-group">
                                <label for="">Icon</label>
                                <input type="text" name="icon" value="" class="form-control"
                                    placeholder="Give a font awesome icon here ex. <i class='fa fa-bars' aria-hidden='true'></i>"
                                    required>
                                @if ($errors->has('icon'))
                                    <div class="text-danger">{{ $errors->first('icon') }}</div>
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
                <h4>Edit Category</h4>
                <p class="mg-b-0">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                    / <a href="{{ url('admin/category/manage') }}">Category</a> / Edit
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
                        <form action="{{ url('admin/category/update/' . $data['category']->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf



                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{ $data['category']->name }}"
                                    class="form-control" placeholder="Category name" required>
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>


                            <div class="form-group">
                                <label for="">Icon</label>
                                <input type="text" name="icon" class="form-control"
                                    value="{{ $data['category']->icon }}"
                                    placeholder="Give a font awesome icon here ex. <i class='fa fa-bars' aria-hidden='true'></i>"
                                    required>
                                @if ($errors->has('icon'))
                                    <div class="text-danger">{{ $errors->first('icon') }}</div>
                                @endif
                            </div>


                            <div class="form-group">
                                <label for="">Priority</label>
                                <input type="number" name="priority" class="form-control"
                                    value="{{ $data['category']->priority }}" placeholder="1" required>
                                @if ($errors->has('priority'))
                                    <div class="text-danger">{{ $errors->first('priority') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="">Status</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="active" {{ $data['category']->status == 'active' ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="disabled"
                                        {{ $data['category']->status == 'disabled' ? 'selected' : '' }}>
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
