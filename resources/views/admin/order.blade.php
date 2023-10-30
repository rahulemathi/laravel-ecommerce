<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
    @include('admin.sidebar')
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h1>All Orders</h1>
                <div class="my-4">
                    <form action="{{ url('search_order') }}" method="get">
                        @csrf
                    <input type="text" name="search" placeholder="search">
                    <input type="submit" value="search" class="btn btn-outline-primary">
                    </form>
                </div>

                <table class="table">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Product Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Payment Status</th>
                        <th>Delivery</th>
                        <th>Image</th>
                        <th>Delivered</th>
                        <th>Print PDF</th>
                        <th>Send Email</th>
                    </tr>
                    

                    @foreach($order as $order)
                    <tr>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->phone}}</td>
                        <td>{{ $order->product_titles }}</td>
                        <td>{{ $order->quantity}}</td>
                        <td>{{ $order->price }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->deliver_status }}</td>
                        <td><img src="/products/{{ $order->image }}" alt="{{ $order->image }}"></td>
                       
                        <td>  @if($order->deliver_status=='processing') <a href="{{ url('delivered/'.$order->id) }}" class="btn btn-success" onclick="return confirm('are you sure this product is delivered')">Delivered</a>
                        @else
                        <p class="text-success">Delivered</p>
                        @endif
                        </td>
                        <td><a href="{{ url('print/'.$order->id) }}" class="btn btn-primary">Print</a></td>
                        <td><a href="{{ url('send_email/'.$order->id) }}" class="btn btn-info">Send Email  </a></td>

                    </tr>

                    @endforeach
                </table>
            </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
   @include('admin.scripts')
  </body>
</html>