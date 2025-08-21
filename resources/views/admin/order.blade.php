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
                <h1 class="h3 mb-4 text-white mt-5">Orders</h1>

                <table class="table table-bordered table-dark text-white text-center mb-0 mt-5">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Product Title</th>
                            <th>Image</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Change Status</th>
                            <th>Invoice</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="align-middle">{{ $order->name }}</td>
                                <td class="align-middle">{{ $order->phone }}</td>
                                <td class="align-middle">{{ $order->rec_address }}</td>
                                <td class="align-middle">{{ $order->product->title }}</td>
                                <td class="align-middle">
                                    <img src="{{ asset('storage/' . $order->product->image) }}" alt="Product Image"
                                        class="img-fluid" style="width: 50px; height: 50px;">
                                </td>
                                <td class="align-middle">{{ $order->product->price }}</td>
                                <td class="align-middle">
                                    @if ($order->status === 'in progress')
                                        <span style="color: #fa0000;">{{ $order->status }}</span>
                                    @elseif($order->status === 'on the way')
                                        <span style="color: #127bf3;">{{ $order->status }}</span>
                                    @else
                                        <span style="color: #27ae60;">{{ $order->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('on_the_way', $order->id) }}" class="btn btn-primary">On the
                                        way</a>
                                    <a href="{{ route('delivered', $order->id) }}"
                                        class="btn btn-success">Delivered</a>
                                </td>
                                <td>
                                    <a href="{{ route('print_invoice',$order->id) }}" class="btn btn-secondary">Print Invoice</a>
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
