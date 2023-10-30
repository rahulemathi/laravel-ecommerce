<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <base href="/public">
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
   </head>
   <body>
      <div class="hero_area">
        @include('home.header')
        <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <img  class="img-fluid "src="/products/{{ $product->image }}" alt="{{ $product->image }}">
            </div>
            <div class="col-sm-12 col-md-6 d-flex flex-column my-4  justify-content-center">
                <h3>Product Details</h3>
                <p>{{ $product->description }}</p>
                <p>Product Catagory: {{ $product->catagory }}</p>
                <h3>Discount Price</h3>
                <p class="text-success">₹ {{ $product->discount_price }}</p>
                <h3>Price</h3>
                <p class="text-danger" style="text-decoration:line-through">₹ {{ $product->price }}</p>

                <div class="d-flex">
                    <form action="{{ url('add_cart/'.$product->id) }}" method="post">
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
                    <a class="btn btn-success" href="">buy now</a>
                </div>
            </div>
        </div>
      </div>
      </div>
      <!-- why section -->
      <
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->

      <!-- jQery -->
 <script src="home/js/jquery-3.4.1.min.js"></script>
 <!-- popper js -->
 <script src="home/js/popper.min.js"></script>
 <!-- bootstrap js -->
 <script src="home/js/bootstrap.js"></script>
 <!-- custom js -->
 <script src="home/js/custom.js"></script>
      
   </body>
</html> 