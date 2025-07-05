<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
</head>

<body>
    @include('admin.header')


    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="h5 mb-2 font-bold text-white">Edit Product</h2>
                        <a href="{{ route('show_product') }}" class="btn btn-success">View Products</a>
                    </div>
                    <form action="{{ route('update_product', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        {{-- @method('POST') <!-- or --}}
                        @method('PUT')
                        <div class="mb-3">
                            <label for="product_name" class="form-label text-white">Product Title</label>
                            <input type="text" class="form-control mb-3 rounded-5 text-white" name="product_name"
                                value="{{ old('product_name', $product->title) }}" placeholder="Product Name" required>
                        </div>

                        <div class="mb-3">
                            <label for="product_price" class="form-label text-white">Product Price</label>
                            <input type="number" class="form-control mb-3 rounded-5 text-white" name="product_price"
                                value="{{ old('product_price', $product->price) }}" placeholder="Product Price" required>
                        </div>

                        <div class="mb-3">
                            <label for="product_quantity" class="form-label text-white">Product Quantity</label>
                            <input type="number" class="form-control mb-3 rounded-5 text-white" name="product_quantity"
                                value="{{ old('product_quantity', $product->quantity) }}" placeholder="Product Quantity"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="product_description" class="form-label text-white">Product Description</label>
                            <textarea class="form-control mb-3 rounded-5 text-white" name="product_description"
                                placeholder="Product Description" required>{{ old('product_description', $product->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label text-white">Category</label>
                            <select class="form-select mb-3 rounded-5 " name="category" id="category" required>
                                <option value="" disabled>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_name }}"
                                        {{ (old('category', $product->category) == $category->category_name) ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="product_image" class="form-label text-white">Product Image</label>
                            <input type="file" class="form-control mb-3 rounded-5 text-white" name="product_image">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image"
                                    style="width: 100px; height: 100px;">
                            @endif
                            {{-- Note: You can't restore old file input for security reasons --}}
                        </div>

                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary text-light" type="submit">Update Product</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- JavaScript files-->
        <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
        <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
        <script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('admincss/js/charts-home.js') }}"></script>
        <script src="{{ asset('admincss/js/front.js') }}"></script>
</body>

</html>
