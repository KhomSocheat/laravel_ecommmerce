<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    @include('home.css')
</head>

<body>
    <div class="hero_area">
        @include('home.header')
    </div>
    <div class="container">
        <h1 class="text-center mt-3 ">My Cart</h1>
        <table class="table table-bordered table-dark text-white mt-2 text-center">
            <thead>
                <tr class="align-middle">
                    <th scope="col">Title</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <?php
            $value = 0;
            ?>
            <tbody>
                @foreach ($cart as $item)
                    <tr class="align-middle">
                        <td class="align-middle">{{ $item->product->title }}</td>
                        <td class="align-middle">{{ $item->product->quantity }}</td>
                        <td class="align-middle">{{ $item->product->price }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="Product Image"
                                style="width:100px; height:100px;">
                        </td>
                        <td class="align-middle">
                            <a href="{{ route('remove_my_cart',$item->id) }}" class="btn btn-danger text-white" >Remove</a>
                        </td>
                    </tr>
                    <?php
                    $value = $value + $item->product->price;
                    ?>
                @endforeach

            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-4">
            <h3 class="text-danger">Total : ${{ $value }}</h3>
        </div>
    </div>



    {{-- @foreach ($cart as $item)
  <h1>{{ $item->user_id }}</h1>
  <h1>{{ $item->product->title }}</h1>
  <h1>{{ $item->user->name }}</h1>
@endforeach --}}










    @include('home.footer')

</body>

</html>
