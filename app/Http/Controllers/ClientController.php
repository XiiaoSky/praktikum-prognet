<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use TransactionDetails;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        return view('client.layout');
    }

    public function cart()
    {
        $cart = Cart::with('products.images')->get();
        // dd($cart);
        return view('admin.cart.cart-index',compact('cart'));
    }

    public function productList()
    {
        $products = Product::with('images')->orderBy('id','desc')->get();
        return view('client.product.list-product', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with('images')->find($id);
        return view('client.product.detail-product',compact('product'));
    }

    public function transaction()
    {
        $transactionByUser =  Transaction::with('user.carts.products')->where('user_id',Auth::user()->id)->get();
       
        // dd($transactionByUser);
        return view('client.transaction.transaction-list',compact('transactionByUser'));
    }

    public function createProofOfPayment($id)
    {   
        $transactionByUser = Transaction::with(['user.carts.products'])->first();
        // dd($transactionByUser);
        return view('client.transaction.proof-of-payment',compact('transactionByUser'));
    }

    public function uploadProofOfPayment($id,Request $request)
    {   

        // Auth User name 
        $username = Auth::user()->name;

        
        $transactionByUser = Transaction::with('user.carts.products')->find($id);
       

        $file = $request->file('proof_of_payment');
        $filename = $file->getClientOriginalName();
       
        $extension = $file->getClientOriginalExtension();

        //uploaded location
        $location = "PaymentProof";

        //uploaded file
        $file->move($location, $username.'-'.$filename);

        $transactionAttribute = [];
        $transactionAttribute['proof_of_payment'] =  $username.'-'.$filename;;
        $updateTransaction = $transactionByUser->update($transactionAttribute);
        
        // if($updateTransaction)
        // {
            
        //     DB::table('transaction_details')->insert([
        //         'transaction_id' => $transactionByUser->id,
        //         'product_id' => $transactionByUser->carts->products->id->first,
        //         'qty' => '',
        //         'discount' => '',
        //         'selling_price' => '',
        //     ]);
        // }

        return view('client.transaction.proof-of-payment',compact('transactionByUser'));
    }

    public function delete($id,Cart $cart)
    {
        $cart = Cart::find($id);
        
        if($cart != null)
        {
            $cart->delete();
            return redirect()->back();
        }

        return redirect()->back();
    }
}
