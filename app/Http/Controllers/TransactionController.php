<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\City;
use App\Models\User;
use App\Models\Province;
use App\Models\Transaction;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class TransactionController extends Controller
{

    // public function index()
    // {
    //     //
    // }

    public function indexOnAdmin()
    {
        $transaction =  Transaction::with('user.carts')->get();
        // dd($transaction);
        return view('admin.transactions.index-transaction', compact('transaction'));
    }

    public function create($id)
    {
        $cart =   Cart::with(['products.images'])->find($id);

        $provinces = Province::pluck('name', 'province_id');
        return view('client.transaction.transaction-create', compact(['provinces', 'cart']));
    }
    public function getCities(Request $request)
    {
        $city = City::where('province_id', $request->province_id)->pluck('name', 'city_id');
        return response()->json($city);
    }

    public function check_ongkir(Request $request)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => $request->city_origin, // ID kota/kabupaten asal
            'destination'   => $request->city_destination, // ID kota/kabupaten tujuan
            'weight'        => $request->weight, // berat barang dalam gram
            'courier'       => $request->courier // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();


        return response()->json($cost);
    }


    public function store($id, Request $request)
    {

        
        // dd($request->all());
        $cart = Cart::with('products')->find($id);
        
        $cartProductPrice = $cart->products->first()->price;
       
        $cartQty = $cart->qty;
       
        $dataTotal = $cartProductPrice  * $cartQty;

        $timeNow = Carbon::now();
        $timeOut = $timeNow->addDays(1);

        $user_id = Auth::user()->id;

        $provinceDestination =   Province::where('id', $request->province_destination)->value('name');
        $cityDestination =   City::where('id', $request->city_destination)->value('name');


        $transactionAttribute = [];
        $transactionAttribute['address'] =  $request->address;
        $transactionAttribute['user_id'] =  $user_id;
        $transactionAttribute['province'] = $provinceDestination;
        $transactionAttribute['regency'] =  $cityDestination;
        $transactionAttribute['courier'] = $request->courier;
        $transactionAttribute['status'] = 'PENDING';
        $transactionAttribute['timeout'] = $timeOut;
        $transactionAttribute['sub_total'] = $cartProductPrice;
        $transactionAttribute['total'] = $dataTotal + $request->shipping_cost;
        $transactionAttribute['shipping_cost'] = $request->shipping_cost;

        // dd($transactionAttribute);
        Transaction::create($transactionAttribute);
        
        return redirect()->route('transaction.list');
    }


    public function show(Transaction $transaction)
    {
        //
    }


    public function edit(Transaction $transaction)
    {
        //
    }


    public function update(Request $request, Transaction $transaction)
    {
        //
    }


    public function destroy(Transaction $transaction)
    {
        //
    }
}
