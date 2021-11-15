<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function viewCart(){
        return view('cart');
    }

    /**
     * Adds a product to session cart
     */
    public function addToCart(Request $request){
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|min:1',
        ]);
        $product = Product::find($request->product_id);

        if(!$product) {
            abort(404,'Product Not Found');
        } 
        $cart = session()->get('cart');
        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                    $request->product_id => [
                        "name" => $product->name,
                        "quantity" => $request->quantity,
                        "price" => $product->price,
                    ]
            ];
            session()->put('cart', $cart);
            return redirect(route('view.cart'));
        }
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity']++;
            session()->put('cart', $cart);
            return redirect(route('view.cart'));
        }
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$request->product_id] = [
            "name" => $product->name,
            "quantity" => $request->quantity,
            "price" => $product->price,
        ];
        session()->put('cart', $cart);
        return redirect(route('view.cart'));
    }

    /**
     * Update cart session
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity)
        {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }

        return null;
    }

    /**
     * Remove item from cart session
     */
    public function remove(Request $request)
    {
        if($request->has('id')) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }

        return null;
    }
}
