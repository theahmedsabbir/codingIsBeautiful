@extends('backend.master')

@section('title')
    Product
@endsection

@section('content')
    @if ($data['page'] == 'index')
        <div class="br-pagetitle">
            <i class="icon ion-android-list"></i>
            <div>
                <h4>Manage Products</h4>
                <p class="mg-b-0">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                    / Product /
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
                                <th class="text-capitalize">Image</th>
                                <th class="text-capitalize">Name</th>
                                <th class="text-capitalize">category</th>
                                <th class="text-capitalize">brand</th>
                                <th class="text-capitalize">Price</th>
                                <th class="text-capitalize">Discount Price</th>
                                <th class="text-capitalize">Qty</th>
                                <th class="text-capitalize">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['products'] as $product)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        @if (count(json_decode($product->images)) > 0)
                                            <img src="{{ asset('/products/' . json_decode($product->images)[0]) }}"
                                                alt="" width="30">
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name ?? 'No brand' }}</td>
                                    <td>{{ $product->brand->name ?? 'No brand' }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->discount_price }}</td>
                                    <td>{{ $product->qty }}</td>
                                    <td>
                                        <a href="{{ url('/admin/product/edit/' . $product->id) }}"
                                            class="btn btn-sm btn-info">Edit</a>
                                        <a href="{{ url('/admin/product/delete/' . $product->id) }}"
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
        {{-- @dd($data['products']) --}}
        <div class="br-pagetitle">
            <i class="icon ion-android-list"></i>
            <div>
                <h4>Create Product</h4>
                <p class="mg-b-0">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                    / <a href="{{ url('admin/product/manage') }}">Product</a> / Create
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
                        <form action="{{ url('admin/product/store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" value="" class="form-control"
                                    placeholder="Product name" required>
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Select a category</label>
                                <select class="form-control" name="sub_cat_id" id="sub_cat_id" required>
                                    <option selected disabled>Select a category</option>
                                    @foreach ($data['categories'] as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('sub_cat_id'))
                                    <div class="text-danger">{{ $errors->first('sub_cat_id') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Select a brand</label>
                                <select class="form-control" name="brand_id" id="brand_id" required>
                                    <option selected disabled>Select a brand</option>
                                    @foreach (App\Models\Brand::orderBy('name', 'asc')->get() as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('brand_id'))
                                    <div class="text-danger">{{ $errors->first('brand_id') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" name="price" value="" class="form-control"
                                    placeholder="Product price" required>
                                @if ($errors->has('price'))
                                    <div class="text-danger">{{ $errors->first('price') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Discount Price <small class="text-danger">( Optional )
                                    </small></label>
                                <input type="number" name="discount_price" value="" class="form-control"
                                    placeholder="Product discount price">
                            </div>
                            <div class="form-group">
                                <label for="">Qty</label>
                                <input type="number" name="qty" value="" class="form-control"
                                    placeholder="Product qty" required>
                                @if ($errors->has('qty'))
                                    <div class="text-danger">{{ $errors->first('qty') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Short description</label>
                                <textarea class="form-control" name="short_description" rows="5" placeholder="Product short description"></textarea>
                                @if ($errors->has('short_description'))
                                    <div class="text-danger">{{ $errors->first('short_description') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Long description</label>
                                <textarea class="form-control" name="long_description" rows="5" placeholder="Product long description"></textarea>
                                @if ($errors->has('long_description'))
                                    <div class="text-danger">{{ $errors->first('long_description') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Images</label>
                                <input type="file" name="images[]" value="" class="form-control"
                                    placeholder="Product qty" accept="images/*" multiple required>
                                @if ($errors->has('images'))
                                    <div class="text-danger">{{ $errors->first('images') }}</div>
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
                <h4>Edit Product</h4>
                <p class="mg-b-0">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                    / <a href="{{ url('admin/product/manage') }}">Product</a> / Edit
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
                        <form action="{{ url('admin/product/update/' . $data['product']->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf



                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{ $data['product']->name }}"
                                    class="form-control" placeholder="Product name" required>
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="">Select a category</label>
                                <select class="form-control" name="sub_cat_id" id="sub_cat_id" required>
                                    <option selected disabled>Select a category</option>
                                    @foreach (App\Models\Category::where('cat_id', '!=', null)->get() as $category)
<option 
                          value="{{ $category->id }}" 
                          {{ $data['product']->sub_cat_id == $category->id ? 'selected' : '' }}
                          >
                          {{ $category->name }}
                          </option>
@endforeach
                    </select>
                    @if ($errors->has('sub_cat_id'))
<div class="text-danger">{{ $errors->first('sub_cat_id') }}</div>
@endif
                </div>
                <div class="form-group">
                    <label for="">Select a brand</label>
                    <select class="form-control" name="brand_id" id="brand_id" required>
                        <option selected disabled>Select a brand</option>
                        @foreach (App\Models\Brand::orderBy('name', 'asc')->get() as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ $data['product']->brand_id == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('brand_id'))
                                    <div class="text-danger">{{ $errors->first('brand_id') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" name="price" value="{{ $data['product']->price }}"
                                    class="form-control" placeholder="Product price" required>
                                @if ($errors->has('price'))
                                    <div class="text-danger">{{ $errors->first('price') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Discount Price <small class="text-danger">( Optional )
                                    </small></label>
                                <input type="number" name="discount_price"
                                    value="{{ $data['product']->discount_price }}" class="form-control"
                                    placeholder="Product discount price">
                            </div>
                            <div class="form-group">
                                <label for="">Qty</label>
                                <input type="number" name="qty" value="{{ $data['product']->qty }}"
                                    class="form-control" placeholder="Product qty" required>
                                @if ($errors->has('qty'))
                                    <div class="text-danger">{{ $errors->first('qty') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Short description</label>
                                <textarea class="form-control" name="short_description" rows="5" placeholder="Product short description">{{ $data['product']->short_description }}</textarea>
                                @if ($errors->has('short_description'))
                                    <div class="text-danger">{{ $errors->first('short_description') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Long description</label>
                                <textarea class="form-control" name="long_description" rows="5" placeholder="Product long description">{{ $data['product']->long_description }}</textarea>
                                @if ($errors->has('long_description'))
                                    <div class="text-danger">{{ $errors->first('long_description') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Images</label>
                                <input type="file" name="images[]" value="" class="form-control"
                                    placeholder="Product qty" accept="images/*" multiple>
                                @if ($errors->has('images'))
                                    <div class="text-danger">{{ $errors->first('images') }}</div>
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
