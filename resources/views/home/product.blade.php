<section class="shop_section layout_padding">
     <div class="container">
         <div class="heading_container heading_center">
             <h2>
                 Latest Products
             </h2>
         </div>
         <div class="row">

            @foreach ($products as $item)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="box">
                            <a href="{{ route('product_details', $item->id) }}">
                                <div class="img-box">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="Product Image" class="img-fluid">
                                </div>
                                <div class="detail-box">
                                    <h6>
                                        {{ $item->title }}
                                    </h6>
                                    <h6>
                                        Price
                                        <span>
                                            {{ $item->price }}$
                                        </span>
                                    </h6>
                                </div>
                            </a>
                            <div class="d-flex justify-content-end align-items-center mt-5">
                                <a href="{{ route('add_cart',$item->id) }}" class="btn btn-primary text-white">Add To Cart</a>
                            </div>

                        </div>
                    </div>
               @endforeach
         </div>
     </div>

 </section>
