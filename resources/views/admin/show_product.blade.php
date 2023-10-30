<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.css')
   <style>
    .imagewidth{
        width: 100px;
        height: auto !important;
    }
   </style>
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
                <h1 class="text-center">All Products</h1>
                @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('message') }}
                </div>
                @endif
                <div class="d-flex justify-content-center">
                <table>
                    <tr>
                        <th>Product Title</th>
                        <th>Description</th>
                        <th>quantity</th>
                        <th>catagory</th>
                        <th>price</th>
                        <th>discount</th>
                        <th>product image</th>
                        <th>edit</th>
                        <th>delete</th>
                    </tr>
                    @foreach($product as $product)
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>{{ Str::of($product->description)->words(10,'...') }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->catagory }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->discount_price }}</td>
                        <td><img class="imagewidth" src="/products/{{ $product->image }}" alt=""></td>
                        <td><a href="{{ url('/delete_product',$product->id) }}" class="btn btn-danger" onclick="return confirm('are you sure')">Delete</a></td>
                        <td><a href="{{ url('/update_product' ,$product->id)}}" class="btn btn-success">Edit</a></td>
                    </tr>
                    @endforeach
                </table>
                </div>
            </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
   @include('admin.scripts')
  </body>
</html>