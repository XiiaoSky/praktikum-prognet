@extends('admin.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Products</h1>
    </div>

    <a href="/admin/add-product" class="btn btn-primary mb-3">Add a Product</a>
    <a href="/admin/product/trash" class="btn btn-danger mb-3">Trash</a>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col" width="150px">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Discount</th>
                <th scope="col">Stock</th>
                <th scope="col">Weight</th>
                <th scope="col" width="250px">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->iteration++ }}</th>

                        @foreach ($product->images as $image)
                    <td><img src="{{ asset('images/' . $image->image_name) }}" class="rounded d-block" width="150px"></td>
            @endforeach
            <td>{{ $product->product_name }}</td>
            <td>
                @php
                    $product->price = 'Rp' . number_format($product->price, 2, '.', ',');
                    echo $product->price;
                @endphp
            </td>


            @forelse ($product->discounts as $discount)
                <td> {{ $discount->percentage }} %</td>
            @empty
                <td>You dont add discount yet </td>
            @endforelse ()

            <td>{{ $product->stock }}</td>
            <td>{{ $product->weight }} gram</td>
            <td>
                <form action="/admin/product/{{ $product->id }}" method="POST">
                    <a href="{{ route('admin.product-detail', $product->id) }}" class="btn btn-success">Detail</a>
                    <a href="{{ route('admin.product-edit', $product->id) }}" class="btn btn-info">Edit</a>
                    <a href="{{ route('admin.product-delete', $product->id) }}" class="btn btn-danger"
                        onclick="return confirm('Are you sure?')">Delete</a>
                </form>
            </td>
            </tr>
            {{-- @empty
                <tr colspan="3">
                    <td class="text-center">No data</td>
                </tr> --}}
            @endforeach
        </tbody>
    </table>
@endsection
