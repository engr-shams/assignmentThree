@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="container">
        <h1>{{ $product->name }}</h1>
        <p>{{ $product->description }}</p>
        <p>Price: ${{ $product->price }}</p>
        <p>Stock: {{ $product->stock }}</p>

        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="300">

        <div class="mt-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back to Previous Page</a>
        </div>
    </div>
@endsection
