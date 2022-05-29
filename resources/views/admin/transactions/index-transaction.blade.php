@extends('admin.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Transaction made by Users</h1>
    </div>
    {{-- <a href="{{route('admin.couriers.create')}}" class="btn btn-primary mb-3">Add a Courier</a> --}}
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Transaction by</th>
                <th scope="col">Proof of payment</th>
                <th scope="col">Address</th>
                <th scope="col">Qty (items)</th>
                <th scope="col">Shipping Cost</th>
                <th scope="col">Time out</th>
                <th scope="col">Total</th>
                <th scope="col">Sub Total</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaction as $key => $transaction)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $transaction->user->name }}</td>

                    <td style="width:150px">

                        @if (empty($transaction->proof_of_payment))
                            No payment proof attached
                        @else
                            <img class="img-thumbnail w-100" src="{{ asset('PaymentProof/' . $transaction->proof_of_payment) }}"
                                alt="">
                        @endif

                    </td>
                    <td>{{ $transaction->address }}</td>
                    <td>{{ $transaction->user->carts->qty}}</td>

                    <td>Rp. {{ $transaction->shipping_cost }}</td>
                    <td>Rp. {{ $transaction->timeout }}</td>
                    <td>Rp.{{ number_format($transaction->sub_total) }}</td>
                    <td>Rp.{{ number_format($transaction->total) }}</td>
                    <td>
                        <a href="{{ route('admin.couriers.edit', $transaction->id) }}" class="btn btn-info">Edit</a>
                        <form action="/admin/couriers/{{ $transaction->id }}/delete" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger my-1" onclick="return confirm('Are you sure?')"
                                value="Delete">
                        </form>
                    </td>
                </tr>
            @empty
                <tr colspan="3">
                    <td class="text-center">No data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
