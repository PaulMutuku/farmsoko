<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItems;


class CheckoutController extends Controller
{
    public function index()
    {
        $old_cartitems = Cart::where('user_id', Auth::id())->get();
        foreach ($old_cartitems as $item) {
            if (!Product::where('id',$item->prod_id)->where('qty',">=",$item->prod_qty)->exists()) 
            {
                $removeItem = Cart::where('user_id', Auth::id())->where('prod_id', $item->prod_id)->first();
                $removeItem->delete();
            }
        }
        $cartitems = Cart::where('user_id', Auth::id())->get();
        return view('frontend.checkout', compact('cartitems'));
    }

    public function placeorder(Request $request)
    {
        $order = new Order();
        $order->user_id = $request->id;
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address1 = $request->input('address1');
        $order->address2 = $request->input('address2');
        $order->city = $request->input('city');
        $order->country = $request->input('country');

        //To calculate total price
        $total = 0;
        $cartitems_total = Cart::where('user_id', Auth::id())->get();
        foreach ($cartitems_total as $prod) {
            $total+= $prod->products->selling_price;
        }

        $order->total_price = $total;

        $order->tracking_no = 'FarmSoko'.rand(1111,9999);
        $order->save();

        $cartitems = Cart::where('user_id', Auth::id())->get();

        foreach ($cartitems as $item) {
            OrderItem::create([
                'order_id'=>$order->id,
                'prod_id'=>$item->prod_id,
                'qty'=>$item->prod_qty,
                'price'=>$item->products->selling_price,
            ]);

            $prod = Product::where('id', $item->prod_id)->first();
            $prod->qty = $prod->qty - $item->prod_qty;
            $prod->update();
        }


        $cartitems = Cart::where('user_id', Auth::id())->get();
        cart::destroy($cartitems);
        return redirect('/')->with('status', "Order Placed Successfully");
        
    }

    public function razorpaycheck(Request $request)
    {
        $cartitems = Cart::where('user_id', Auth::id())->get();
        $total_price = 0;
        foreach ($cartitems as $items) 
        {
           $total_price += $item->products->selling_price * $item->prod_qty;
        }

        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email= $request->input('email');
        $phone= $request->input('phone');
        $address1= $request->input('address1');
        $address2= $request->input('address2');
        $city= $request->input('city');
        $country= $request->input('country');

        return response()->json([
                 'firstname'=> $firstname,
                 'lastname'=>  $lastname,
                 'email'=>  $email,
                 'phone'=>  $phone,
                 'address1'=>  $address1,
                 'address2'=>  $address2,
                 'city'=>  $city,
                 'country'=>  $country,
                 'total_price'=> $total_price
        ]);
    }
}
