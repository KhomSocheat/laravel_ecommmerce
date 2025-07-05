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
            <h2 class="h5 mb-5 font-bold text-white">Add Category</h2>
            <form action="{{ route('add_category') }}" method="POST">
                @csrf
                <div>
                    <input type="text" class="form-control mb-3 rounded-5" name="category_name" placeholder="Category Name" required>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary text-light" type="submit">Add Category</button>
                </div>
            </form>

            <div>
                <div>
                    <table class="table table-striped table-bordered mt-5">
                        <thead>
                            <tr class="text-white">
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                                @foreach ($data as $categories)
                                 <tr class="text-white">
                                    <td>
                                        {{ $categories->id }}
                                    </td>
                                    <td>
                                        {{ $categories->category_name }}
                                    </td>
                                    <td>
                                        <a href="{{ route('edit_category',$categories->id) }}" class="btn btn-success">Edit</a>
                                        <a href="{{ route('delete_category', $categories->id) }}" onclick="confirmation(event)" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

          </div>
      </div>
    </div>
    <!-- SweetAlert JS (should be before your custom JS) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        function confirmation(ev){
            console.log('confirmation called');
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this category!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete)=>{
                if(willDelete){
                    window.location.href= urlToRedirect;
                }
            });
        }
    </script>
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
