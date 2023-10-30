<section class="product_section layout_padding">
   <div class="container">
      <div class="heading_container heading_center">

            <div>
              <form action="{{ url('search_product') }}" method="GET">
              <input type="text" name="search" placeholder="search">
              <input type="submit" value="search">
              </form>
            </div>
         </h2>
      </div>
      @if(session()->has('message'))
      <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
          {{ session()->get('message') }}
      </div>
      @endif
      <div class="row">
        @foreach($product as $products)
         <div class="col-sm-6 col-md-4 col-lg-4">
            <div class="box">
               <div class="option_container">
                  <div class="options">
                     <a href="{{ url('product_details/'.$products->id) }}" class="option1">
                     Product Details
                     </a>
                    <form action="{{ url('add_cart/'.$products->id) }}" method="post">
                       @csrf
                       <div class="row mt-4 px-4">
                          <div class="col-md-4">
                       <input class="rounded-pill" type="number" name="quantity" value="1" min="1">
                          </div>
                          <div class="col-md-8">
                       <input class="rounded-pill" type="submit" value="Add to cart">
                          </div>
                       </div>
                    </form>
                  </div>
               </div>
               <div class="img-box">
                  <img src="/products/{{ $products->image }}" alt="{{ $products->image }}">
               </div>
               <div class="detail-box">
                  <h5>
                     {{ $products->title }}
                  </h5>
                  @if($products->discount_price!=null)
                  <h6 class="text-success">
                    Discount Price
                    <br>
                    ₹{{ $products->discount_price }}
                 </h6>
                  <h6 class="text-danger" style="text-decoration:line-through">
                    price
                     ₹{{ $products->price }}
                  </h6>
                  @else
                  <h6 class="text-success">
                    price
                    ₹{{ $products->price }}
                 </h6>
                  @endif
               </div>
            </div>
         </div>
         @endforeach

         {!! $product->withQueryString()->links('pagination::bootstrap-5') !!}
       
   </div>
</section>