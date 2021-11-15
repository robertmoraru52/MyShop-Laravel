<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class CheckoutController extends Controller
{
    /**
     * Insert into orders table details for shipping and sync with products in pivot table
     */
    public function checkoutView(Request $request){
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        try{
            $orders = Order::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
            foreach(session('cart') as $key => $prod){
                $orders->products()->attach($key,['quantity' => $prod['quantity']]);
            }

            $total = 0;
            foreach((array) session('cart') as $details){
                $total += $details['price'] * $details['quantity'];
            }

            return view('checkout',compact('total'));
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error', 'There was an error');
        }

    }
    
    /**
     * Deletes all items from session cart and reduces the stock of the product accordingly to qunatity ordered
     */
    public function checkoutBuyNow(){
        try{
            foreach(session('cart') as $key=>$cartList){
                $products = Product::find($key);
                $products->update(['stock' => $products->stock - $cartList['quantity']]);
            }
            session()->forget('cart');       
            session()->flash('success', 'Order has been placed');

            return redirect(route('homepage'));
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error', 'There was an error');
        }
    }

    /**
     * Returns order details view if cart is not empty
     */
    public function orderDetailsView(){
        if(session('cart') != null){
            return view('order-details');
        }
        else{
            return redirect(route('view.cart'))->with('error','Cart Empty');
        }
    }


}
