<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
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
                <h1>Update Product</h1>
                @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('message') }}
                </div>
                @endif
                <form action="{{ url('/updated_product/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div>
                <label for="">Change Name</label>
                <input type="text" name="product" placeholder="product name" value="{{ $product->title }}">
                </div>

                <div>
                    <label for="">Change Product Description</label>
                    <input type="text" name="product_description" placeholder="Product Description" value="{{ $product->description }}">
                    </div>
                
                <div>
                    <label for="">Change Product price</label>
                    <input type="number" name="product_price" placeholder="product price" value="{{ $product->price }}">
                    </div>

                    <div>
                        <label for="">Change Product Quantity</label>
                        <input type="number" name="product_quantity" placeholder="product quantity" min="0" value="{{ $product->quantity }}">
                        </div>

                        <div>
                            <label for="">Change Discount Price</label>
                            <input type="number" name="discount_price" placeholder="discount price" min="0" value="{{ $product->discount_price }}">
                            </div>

                            <div>
                                <label for="">Change Prodcut Catagory  </label>
                                <select name="product_catagory" id="">
                                    <option value="" disabled>Select Catagory</option>
                                   
                                    <option value="{{ $product->catagry }}" selected>{{ $product->catagory }}</option>
                                    @foreach($catagory as $catagory)
                                    <option value="{{ $catagory->catagory_name }}">{{ $catagory->catagory_name }}</option>
                                  @endforeach
                                </select>
                                </div>

                                <div>
                                    <label for="">Current Image</label>
                                    <img src="/products/{{ $product->image }}" alt="" width="100px">
                                </div>

                                <div>
                                    <label for="">Change Product Image</label>
                                    <input type="file" name="product_image">
                                    </div>

                                    <input type="submit" class="btn btn-primary" value="update product">
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