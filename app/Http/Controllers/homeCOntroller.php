<?php

namespace App\Http\Controllers;

use Stripe;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Reply;
use App\Models\comment;

use App\Models\Product;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Notifications\emailNotification;
use Illuminate\Support\Facades\Notification;

class homeCOntroller extends Controller
{
    //

    public function redirect(){
        $usertype = Auth::user()->usertype;

        if($usertype == 1){
            $totalproduct = Product::all()->count();
            $totalorder = Order::all()->count();
            $totaluser = User::all()->count();
            $order=Order::all();
            $totalrevenue = 0;
            foreach($order as $order){
                $totalrevenue = $totalrevenue + $order->price;
            }
            $totaldelivered = Order::where('deliver_status','=','delivered')->get()->count();
            $totalprocessing = Order::where('deliver_status','=','processing')->get()->count();
            return view('admin.home',compact('totalproduct','totalorder','totaluser','totalrevenue','totaldelivered','totalprocessing'));
        }else{
            $product = Product::paginate(10);
            $comment = comment::orderby('id','desc')->get();
            $reply = Reply::all();
            return view('home.userpage',compact('product','comment','reply'));
        }
    }

    public function index(){
        $comment = comment::orderby('id','desc')->get();
        $product = Product::paginate(10);
        $reply = Reply::all();
        return view('home.userpage',compact('product','comment','reply'));
    }

    public function product_details($id){
 $product = Product::find($id);
        return view('home.product_details',compact('product'));
    }
    
    public function cart(){
        if(Auth::id()){
            $id = Auth::user()->id;
            $cart = Cart::where('user_id','=',$id)->get();
            return view('home.cart',compact('cart'));
        }else{
            return redirect('login');
        }
       
    }

    public function remove_cart($id){
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

    public function cash_order(){
        $user = Auth::user();

        $userid = $user->id;

        $data = Cart::where('user_id','=',$userid)->get();

        foreach($data as $data){
            $order = new Order();
            $order->name= $data->customer;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;
            $order->product_titles = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image= $data->image;
            $order->product_id= $data->product_id;
            $order->payment_status='cash on delivery';
            $order->deliver_status='processing';

            $order->save();

            $cart_id = $data->id;
            $cart =Cart::find($cart_id);
            $cart->delete();    
            
        }

        return redirect()->back();
    }

    public function card_payment($totalprice){
        return view('home.stripe',compact('totalprice'));
    }

     public function stripePost(Request $request,$totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));


    
        Stripe\PaymentIntent::create ([ //used payment intent insted of charge
                "amount" => $totalprice * 100,
                "currency" => "inr",
                // "source" => $request->stripeToken, commented because shoudnt use the token.
                "description" => "Thank you" 
        ]);

        $user = Auth::user();

        $userid = $user->id;

        $data = Cart::where('user_id','=',$userid)->get();

        foreach($data as $data){
            $order = new Order();
            $order->name= $data->customer;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;
            $order->product_titles = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image= $data->image;
            $order->product_id= $data->product_id;
            $order->payment_status='paid';
            $order->deliver_status='processing';

            $order->save();

            $cart_id = $data->id;
            $cart =Cart::find($cart_id);
            $cart->delete();    
            
        }
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }

    public function order(){
        $order = Order::all();
        return view('admin.order',compact('order'));
    }
    

    public function delivered($id){
        $order = Order::find($id);

        $order->deliver_status = "delivered";

        $order->save();

        return redirect()->back();
    }

    public function print($id){

        $order = Order::find($id);
        
        $pdf = app('dompdf.wrapper')->loadview('admin.pdf',compact('order'));
        return $pdf->download('order_details.pdf');
    }   

    public function send_email($id){

        $order =  Order::find($id);
        return view('admin.email_info',compact('order'));
    }

    public function send_user_email(Request $request, $id){
        $order = Order::find($id);

        $details = [
            'greeting'=> $request->greeting,
            'firstline'=> $request->firstline,
            'body'=> $request->body,
            'buttons'=> $request->buttons,
            'url'=>$request->emailurl,
            'finishline'=> $request->finishline
        ];

        Notification::send($order,new emailNotification($details));

            return redirect();
    }
    
    public function search_order(Request $request){
                    $search = $request->search;
                    $order = Order::where('name','LIKE',"%$search%")->orWhere('phone','LIKE',"%$search%")->orWhere('product_titles','LIKE',"%$search%")->get();
                    return view('admin.order',compact('order'));
    }
    

    public  function show_order(){
        if(Auth ::id()){

            $user = Auth::user();
            $userid = $user->id;
            $order = Order::where('user_id','=',$userid)->get();
            return view('home.order',compact('order'));
        }else{
            return redirect('login');
        }
    }

    public function cancel_order($id){
        $order = Order::find($id);
        $order->deliver_status = 'You cancelled the order';
        $order->save();

        return redirect()->back();
    }

    public function add_comment(Request $request){
        if(Auth::id()){
        $comment = new comment;
        $comment->name=Auth::user()->name;
        $comment->user_id=Auth::user()->id;
        $comment->comment = $request->comment;
            $comment->save();
            return redirect()->back();

        }else{
            return redirect('login');
        }
    }
    
    public function add_reply(Request $request){
        if(Auth::id()){
            $reply = new Reply;
            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->comment_id = $request->commentid;
            $reply->reply = $request->reply;
            $reply->save();
            return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    public function product_search(Request $request){
        $search = $request->search;
        $comment = comment::orderby('id','desc')->get();
        $reply = Reply::all();
        $product = Product::where('title','LIKE',"%$search%")->orWhere('catagory','LIKE',"%$search%")->paginate(10);

        return view('home.userpage',compact('product','comment','reply'));
    }

    public function products(){
        $product = Product::paginate(10);
        $comment = comment::orderby('id','desc')->get();
        $reply = Reply::all();
        return view('home.all_products',compact('product','comment','reply'));
    }

    public function search_product(Request $request){
        $search = $request->search;
        $comment = comment::orderby('id','desc')->get();
        $reply = Reply::all();
        $product = Product::where('title','LIKE',"%$search%")->orWhere('catagory','LIKE',"%$search%")->paginate(10);

        return view('home.all_products',compact('product','comment','reply'));
    }
    
}
