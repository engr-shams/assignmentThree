@extends('layouts.app')

@section('title', 'Product List')

@section('content')
    <div class="container d-flex flex-column align-items-center" style="min-height: 100vh;">
        <div class="d-flex justify-content-between align-items-center w-100 mb-4">
            <h3>Product Management</h3>

            <form method="GET" action="{{ route('products.index') }}" class="d-flex w-50">
                <input type="text" name="search" class="form-control" placeholder="Search by product ID, name, description, or price" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary ms-2">Search</button>
            </form>

            <a href="{{ route('products.create') }}" class="btn btn-success">Create New Product</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 10%; text-align: center">Prod ID</th>
                    <th style="width: 12%; text-align: center">
                        <a href="{{ route('products.index', ['sort_by' => 'name', 'direction' => request('direction', 'asc') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}">
                            Name
                            @if (request('sort_by') === 'name')
                                <span class="small">
                                    ({{ request('direction') === 'asc' ? '↑' : '↓' }})
                                </span>
                            @endif
                        </a>
                    </th>
                    <th  style="text-align: center">
                        <a href="{{ route('products.index', ['sort_by' => 'price', 'direction' => request('direction', 'asc') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}">
                            Price
                            @if (request('sort_by') === 'price')
                                <span class="small">
                                    ({{ request('direction') === 'asc' ? '↑' : '↓' }})
                                </span>
                            @endif
                        </a>
                    </th>
                    <th style="width: 40%; text-align: center">Description</th>
                    <th style="width: 12%; text-align: center">Image</th>
                    <th style="width: 20%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->product_id }}</td>
                        <td>{{ $product->name }}</td>
                        <td style="width: 10%; text-align: right">${{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->description }}</td>
                        <td style="width: 12%; text-align: center">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="auto" height="50">
                        </td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $products->appends(request()->except('page'))->links('pagination.custom') }}
        </div>
    </div>
@endsection
