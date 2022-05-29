@extends('client.layout')
<title>
    Your transaction</title>
@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-md-12 mr-0 p-0">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Your Transaction List </h4>

                        {{-- @if (count($cart) == 0)
                            <h1> Your cart is empty</h1>
                        @else --}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Transaction id</th>
                                    <th class="pl-5">Address</th>
                                    <th scope="col">Regency</th>
                                    <th scope="col">Province</th>
                                    <th scope="col"> Qty</th>
                                    <th scope="col">Proof Payment</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Shipping Cost</thc>
                                    <th scope="col">Sub Total </th>
                                    <th scope="col">Total </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactionByUser as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id }} </td>
                                        <td class="pl-5 pt-3 pb-3">{{ $transaction->address }} </td>
                                        <td class="pt-3 pb-3">{{ $transaction->regency }}</td>
                                        <td class="pt-3 pb-3">{{ $transaction->province }}</td>
                                        <td class="pt-3 pb-3">{{ $transaction->user->carts->pluck('qty')->first()}}</td>
                                        <td>
                                            @empty($transaction->proof_of_payment)
                                                <div class="text-wrap py-2" style="width:180px">
                                                    You still not attached proof of payment yet for this product <br>
                                                    <a href="{{ route('transaction.proofOfPayment', $transaction->id) }}"
                                                        class="mt-2 btn btn-info">Complete your transaction</a>
                                                </div>
                                            @endempty
                                            <img class="img-thumbnail" style="width:auto; max-height:150px;"
                                            src="{{ asset('PaymentProof/' . $transaction->proof_of_payment) }}" alt="">
                                        </td>

                                       
                                        <td class="fw-bold pt-3 pb-3"> <span> {{ $transaction->status }} </span></td>
                                        <td class="fw-bold pt-3 pb-3">Rp.{{ number_format($transaction->shipping_cost) }}</td>
                                        <td class="fw-bold pt-3 pb-3">Rp.{{ number_format($transaction->sub_total) }}</td>
                                        <td class="fw-bold pt-3 pb-3">Rp.{{ number_format($transaction->total) }}</td>
                                </tr>


                            @empty
                                You dont have any transaction yet
                            @endforelse



                        </tbody>
                    </table>
                    {{-- @endif --}}

                </div>
            </div>
        </div>
        {{-- <div class="col-md ml-0 p-0 bg">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="card-title mb-4"> Jumlah </h4>
                    <hr>
                    <h5>Items : <label for="" class="badge badge-info">6</label> </h5>
                    <h5> Price : Rp.500000 </h5>
                    <button class="btn btn-dark btn-block rounded-0">Proceed</button>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection


{{-- @foreach ($transaction->user->cart as $cart)
                                            @foreach ($cart->products->images as $images)
                                                <td>
                                                    <img class="img-thumbnail"
                                                        src="{{ asset('images/'.$images->image_name) }}" alt="">
                                                </td>
                                            @endforeach
                                            <td class="pl-5 pt-5">{{ $cart->products->product_name }}</td>
                                            <td class="fw-bold pt-5">Rp.{{ number_format($cart->products->price) }}</td>
                                            <td class="fw-bold pt-5">Rp.{{ number_format($transaction->shipping_cost) }}
                                            </td>
                                            <td>{{ $cart->qty }}</td>
                                            <td>
                                                @empty($transaction->proof_of_payment)
                                                    <div class="text-wrap py-2" style="width:250px">
                                                        You still not attached proof of payment yet for this product <br>
                                                        <a href="{{ route('user.transaction.proofOfPayment', $transaction->id) }}"
                                                            class="mt-2 btn btn-info">Complete your transaction</a>
                                                    </div>
                                                @endempty
                                                <img class="img-thumbnail" style="width:auto; max-height:150px;"
                                                    src="{{ asset('PaymentProof/' . $transaction->proof_of_payment) }}"
                                                    alt="">
                                            </td>
                                            <td class="fw-bold pt-5"> <span> {{ $transaction->status }} </span></td>
                                            <td class="fw-bold pt-5">Rp.{{ number_format($transaction->sub_total) }}</td>
                                            <td class="fw-bold pt-5">Rp.{{ number_format($transaction->total) }}</td>

                                       
                                    @endforeach --}}
