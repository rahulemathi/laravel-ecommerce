<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Catagory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    //
    public function view_catagory(){
        if(Auth::id()){
        $data = catagory::all();
        return view('admin.catagory',compact('data'));
        }else{
            return redirect('login');
        }
    }

    public function add_catagory(Request $request){
        $data = new Catagory;
        $data->catagory_name = $request->name;
        $data->save();

        return redirect()->back()->with('message','Catagory Added');
    }
    
    public function delete_catagory($id){
        $data=Catagory::find($id);

        $data->delete();

        return redirect()->back()->with('message','catagory deleted ');
    }

    public function view_product(){
        $catagory = Catagory::all();
        return view('admin.product',compact('catagory'));
    }

    public function add_product(Request $request){
        $product = new Product;

        $product->title=$request->product;
        $product->price=$request->product_price;
        $product->description=$request->product_description;
        $product->discount_price=$request->discount_price;
        $product->catagory=$request->product_catagory;
        $product->quantity=$request->product_quantity;
        $image = $request->product_image;
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->product_image->move('products',$imagename);
        $product->image=$imagename;
        $product->save();

        return redirect()->back()->with('message','product addedd');
    }

    public function show_product(){

        $product =Product::all();
        return view('admin.show_product',compact('product'));
    }

    public function delete_product($id){
        $product = Product::find($id);
        
        $product->delete();

        return redirect()->back()->with('message','product deleted');
    }

    public function update_product($id){
        $product =Product::find($id);
        $catagory = Catagory::all();
        return view('admin.update_product',compact('product','catagory'));
    }

    public function updated_product(Request $request,$id){
        $product = Product::find($id);

        $product->title=$request->product;
        $product->price=$request->product_price;
        $product->description=$request->product_description;
        $product->discount_price=$request->discount_price;
        $product->catagory=$request->product_catagory;
        $product->quantity=$request->product_quantity;
        $image = $request->product_image;
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->product_image->move('products',$imagename);
            $product->image=$imagename;
        }
      
        $product->save();

        return redirect()->back()->with('message','successfully updated');
    }

    public function add_cart(Request $request, $id){
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $product = Product::find($id);
            $product_exist_id = Cart::where('product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();
            if($product_exist_id){
                    $cart = Cart::find($product_exist_id)->first();
                    $quantity = $cart->quantity;
                    $cart->quantity = $quantity + $request->quantity;
                    if($product->discount_price!=null){
                        $cart->price = $product->discount_price * $cart->quantity;
                    }else{
                        $cart->price = $product->price * $request->quantity;
                    }
                    $cart->save();
                    Alert::success('Product Added','You have added product');
                    return redirect()->back()->with('message','product added');
            }else{
            $cart = new Cart;
            
            $cart->customer = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->product_title = $product->title;
            if($product->discount_price!=null){
                $cart->price = $product->discount_price * $request->quantity;
            }else{
                $cart->price = $product->price * $request->quantity;
            }
            
            $cart->image = $product->image;
            $cart->product_id = $product->id;
            $cart->quantity = $request->quantity;

            $cart->save();
            return redirect()->back()->with('message','product added');
        }
        }else{
            return redirect('login');
        }
    }

}
