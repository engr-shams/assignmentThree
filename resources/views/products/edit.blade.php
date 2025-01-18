@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="container">
        <h3>Edit Product</h3>

        <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label text-start">Product Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="description" class="col-sm-2 col-form-label text-start">Description</label>
                <div class="col-sm-10">
                    <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="price" class="col-sm-2 col-form-label text-start">Price</label>
                <div class="col-sm-10">
                    <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="stock" class="col-sm-2 col-form-label text-start">Stock</label>
                <div class="col-sm-10">
                    <input type="number" name="stock" class="form-control" value="{{ $product->stock }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="image" class="col-sm-2 col-form-label text-start">Product Image</label>
                <div class="col-sm-10">

                    <div>
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="120">
                    </div>
                    <br>

                    <input type="file" name="image" id="image">
                    <p class="text-muted">Leave blank to keep the current image.</p>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>

        <div class="mt-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back to Previous Page</a>
        </div>
    </div>
@endsection
