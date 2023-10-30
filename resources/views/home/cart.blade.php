<!DOCTYPE html>
<html>
   <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <!-- Basic -->
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
       

        <div>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Product Title</th>
                        <th>Product Quantity</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $totalprice = 0; ?>
                    @foreach($cart as $cart)
                    <tr>
                        <td>{{ $cart->product_title }}</td>
                        <td>{{ $cart->quantity }}</td>
                        <td>{{ $cart->price }}</td>
                        <td><img src="/products/{{ $cart->image }}" alt="{{ $cart->image }}" width="100px"></td>
                        <td><a href="{{ url('remove_cart/'.$cart->id) }}" class="btn btn-danger" onclick="confirmation(event)">Remove</a></td>
                    </tr>

                    <?php $totalprice = $totalprice + $cart->price; ?>
                    @endforeach
                </tbody>
              </table>
         </div>
         <div class="text-center">
            <p>Total Price : {{ $totalprice }}</p>
         </div>
         <div class="text-center">
            <a href="{{ url('cash_order') }}" class="btn btn-primary">Cash on delivery</a>
            <a href="{{ url('stripe/'.$totalprice) }}" class="btn btn-success">Pay using card</a>
         </div>
      </div>
      <!-- why section -->
    
      <!-- end client section -->
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

 <script>
    function confirmation(ev){
        ev.preventDefault();
        var urlRedirect = ev.currentTarget.getAttribute('href');
        swal({
            title:"are you sure",
            text:"you can add to cart when ever you needed",
            icon:"warning",
            dangerMode:true,
            buttons:true
        }).then((willCancel)=>{
            if(willCancel){
                window.location.href=urlRedirect
            }
        })
    }
 </script>
      
   </body>
</html>