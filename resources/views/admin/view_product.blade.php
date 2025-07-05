<!DOCTYPE html>
<html>
   <head>
        <!-- Bootstrap 5 CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        @include('admin.css')
  </head>
  <body>
        @include('admin.header')


        @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h5 mb-2 font-bold text-white">View Products</h2>
                {{-- search --}}
                <form>
                    <input type="search" name="search" class="form-control mb-3" placeholder="Search Products" value="{{ request()->input('search') }}">
                </form>
            </div>
            <table class="table table-striped table-bordered mt-5 text-center align-middle">
                <thead>
                    <tr class="text-white">
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Qty</th>
                        <th>price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($products as $product)
                    <tr class="text-white">
                        <td class="align-middle">{{ $product->id }}</td>
                        <td class="align-middle">{{ $product->title }}</td>
                        <td class="align-middle">{{ $product->description }}</td>
                        <td class="align-middle">{{ $product->category }}</td>
                        <td class="align-middle">{{ $product->quantity }}</td>
                        <td class="align-middle">{{ $product->price }}</td>
                        <td class="align-middle">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" style="width: 100px; height: 100px;">
                        </td>
                        <td class="align-middle">
                            <a href="{{ route('edit_product',$product->id) }}" class="btn btn-success">Edit</a>
                            <a href="{{ route('delete_product',$product->id) }}" onclick="confirmation(event)" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end mt-4">
                {{ $products->links() }}
            </div>
          </div>

      </div>

    </div>
    <!-- Add SweetAlert before your custom JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/JavaScript">
        function confirmation(ev){
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this category!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willCancel)=>{
                if(willCancel){
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
