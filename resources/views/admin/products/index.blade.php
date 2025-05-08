@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Shop</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if($product->image)
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" style="max-height: 50px;">
                                @else
                                    <img src="{{ asset('img/products/item-1.png') }}" alt="{{ $product->name }}" style="max-height: 50px;">
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->shop->shop_name ?? $product->shop->user->name ?? 'N/A' }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>
                                @if($product->price_sale)
                                    <del>${{ number_format($product->price, 2) }}</del><br>
                                    <strong>${{ number_format($product->price_sale, 2) }}</strong>
                                @else
                                    ${{ number_format($product->price, 2) }}
                                @endif
                            </td>
                            <td>{{ $product->in_stock }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No products found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
@stop