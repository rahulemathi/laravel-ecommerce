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
            <div class="text-center">
                <h1>Add Product</h1>
                @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('message') }}
                </div>
                @endif
                <form action="{{ url('/add_product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div>
                <label for="">Add Name</label>
                <input type="text" name="product" placeholder="product name">
                </div>

                <div>
                    <label for="">Product Description</label>
                    <input type="text" name="product_description" placeholder="Product Description">
                    </div>
                
                <div>
                    <label for="">Product price</label>
                    <input type="number" name="product_price" placeholder="product price">
                    </div>

                    <div>
                        <label for="">Product Quantity</label>
                        <input type="number" name="product_quantity" placeholder="product quantity" min="0">
                        </div>

                        <div>
                            <label for="">Discount Price</label>
                            <input type="number" name="discount_price" placeholder="discount price" min="0">
                            </div>

                            <div>
                                <label for="">Prodcut Catagory  </label>
                                <select name="product_catagory" id="">
                                    <option value="" selected disabled>Select Catagory</option>
                                    @foreach($catagory as $catagory)
                                    <option value="{{ $catagory->catagory_name }}">{{ $catagory->catagory_name }}</option>
                                    @endforeach
                                </select>
                                </div>

                                <div>
                                    <label for="">Product Image</label>
                                    <input type="file" name="product_image">
                                    </div>

                                    <input type="submit" class="btn btn-primary" value="add product">
                </form>
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