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
            <h2 class="h5 mb-5 font-bold text-white">Edit Category</h2>
            <form action="{{ route('update_category', $category->id) }}" method="POST">
                @csrf
                <div>
                    <input type="text" class="form-control mb-3 rounded-5" name="category_name" value="{{ $category->category_name }}" required>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary text-light" type="submit">Update Category</button>
                </div>
            </form>

            <div>
                <div>
                    <table class="table table-striped table-bordered mt-5">
                        <thead>
                            <tr class="text-white">
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($data as $categories)
                                 <tr class="text-white  ">
                                    <td>
                                        {{ $categories->id }}
                                    </td>
                                    <td>
                                        {{ $categories->category_name }}
                                    </td>
                                    <td>
                                        <a href="{{ route('edit_category', $categories->id) }}" class="btn btn-success">Edit</a>
                                        <a href="{{ route('delete_category', $categories->id) }}" onclick="confirmation(event)" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>

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
