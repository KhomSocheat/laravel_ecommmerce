<!DOCTYPE html>
<html>
<head>
    @include('home.css')
</head>
<body>
    <div class="hero_area">
        @include('home.header')
    </div>

    <div class="container my-5">
        <h1 class="text-center mb-4">My Cart</h1>

        {{-- Order Form --}}
        <form action="{{ route('order_confirm') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label for="receiverName" class="form-label">Receiver Name</label>
                    <input
                        type="text"
                        id="receiverName"
                        name="name"
                        class="form-control"
                        placeholder="Enter receiver’s name"
                        required
                    >
                </div>
                <div class="col-md-4">
                    <label for="receiverPhone" class="form-label">Receiver Phone</label>
                    <input
                        type="tel"
                        id="receiverPhone"
                        name="phone"
                        class="form-control"
                        placeholder="e.g. +1 (555) 123-4567"
                        required
                    >
                </div>
                <div class="col-md-4 mb-3">
                    <label for="receiverAddress" class="form-label">Receiver Address</label>
                    <textarea
                        id="receiverAddress"
                        name="rec_address"
                        class="form-control"
                        rows="1"
                        placeholder="Enter delivery address"
                        required
                    ></textarea>
                </div>
                <div class="col-12 d-flex justify-content-end ">
                    <button type="submit" class="btn btn-primary">Place Order</button>
                </div>
            </div>
        </form>

        {{-- Cart Table --}}
        <div class="table-responsive">
            <table class="table table-bordered table-dark text-white text-center mb-0">
                <thead class="table-secondary text-dark align-middle">
                    <tr>
                        <th scope="col" class="align-middle">Title</th>
                        <th scope="col" class="align-middle">Quantity</th>
                        <th scope="col" class="align-middle">Price</th>
                        <th scope="col" class="align-middle">Image</th>
                        <th scope="col" class="align-middle">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $value = 0; @endphp
                    @foreach ($cart as $item)
                        <tr class="align-middle">
                            <td class="align-middle">{{ $item->product->title }}</td>
                            <td class="align-middle">{{ $item->product->quantity }}</td>
                            <td class="align-middle">${{ number_format($item->product->price, 2) }}</td>
                            <td class="align-middle">
                                <img
                                    src="{{ asset('storage/' . $item->product->image) }}"
                                    alt="Product Image"
                                    class="img-thumbnail"
                                    style="width:100px; height:100px;"
                                >
                            </td>
                            <td class="align-middle">
                                <a
                                    href="{{ route('remove_my_cart', $item->id) }}"
                                    class="btn btn-sm btn-danger"
                                >
                                    Remove
                                </a>
                            </td>
                        </tr>
                        @php $value += $item->product->price; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Total --}}
        <div class="d-flex justify-content-end mt-3">
            <h3 class="text-danger">Total: ${{ number_format($value, 2) }}</h3>
        </div>
    </div>

    @include('home.footer')
</body>
</html>
