<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $carts = Cart::with(['product.galleries', 'user'])->where('users_id', Auth::user()->id)->get();
        // $stok = Product::findOrFail();
        // dd($carts); 
        
        return view('pages.cart',[
            'carts' => $carts
        ]);
    }


    public function delete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete();

        return redirect()->route('cart');
    }
    
    public function success()
    {
        return view('pages.success');
    }

    public function increment($id){
        // dd($id);
        $transaction = cart::find($id);

        $transaction->update([
            'qty'=>$transaction->qty + 1,
            'total'=>$transaction->product->price*($transaction->qty + 1)
        ]);
        return redirect()->route('cart');
    }
    public function decrement($id){
        // dd($id);
        $transaction = cart::find($id);

        $transaction->update([
            'qty'=>$transaction->qty - 1,
            'total'=>$transaction->product->price*($transaction->qty - 1)
        ]);
        return redirect()->route('cart');
    }
    
}
