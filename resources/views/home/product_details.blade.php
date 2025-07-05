<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
    @include('home.css')
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')

  </div>

  {{-- product detail start --}}

    <section class="shop_section layout_padding">
     <div class="container">
         <div class="heading_container heading_center">
             <h2 class="text-center ">
                 Products Detail
             </h2>
         </div>
         <div class="row">
                    <div class=" col-md-12 ">
                        <div class="box">
                            <a href="{{ route('product_details', $product->id) }}">
                                <div class="d-flex justify-content-center align-items-center mb-4">
                                    <img width="400" src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-fluid">
                                </div>
                                <div class="detail-box">
                                    <h6>Product Name: {{ $product->title }}</h6>
                                    <h6>Price:
                                        <span>
                                            ${{ $product->price }}$
                                        </span>
                                    </h6>
                                </div>
                                <div class="detail-box">
                                    <h6>Category: {{ $product->category }}</h6>
                                    <h6>Avaliable Quantity:
                                        <span>
                                            {{ $product->quantity }}
                                        </span>
                                    </h6>
                                </div>
                                <div class="detail-box">
                                    <p>Description: {{ $product->description }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
         </div>
     </div>

 </section>


  {{-- product detail end  --}}

  <!-- contact section -->

        @include('home.contact')

  <!-- end contact section -->



  <!-- info section -->

  @include('home.footer')

</body>

</html>
