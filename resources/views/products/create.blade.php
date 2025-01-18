@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
    <div class="container">
        <h3>Create a New Product</h3>

        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf            

            <div class="mb-3 row">
                <label for="product_id" class="col-sm-2 col-form-label">Product ID</label>
                <div class="col-sm-10">
                    <input type="text" name="product_id" class="form-control" id="product_id" placeholder="Product ID" readonly style="cursor: not-allowed;" aria-describedby="productIdHelp">
                    <small id="productIdHelp" class="form-text text-muted">Product ID will be generated automatically based on the product name.</small>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Product Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter product name" oninput="generateProductId()" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea name="description" class="form-control" id="description" placeholder="Description"></textarea>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="price" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-10">
                    <input type="number" name="price" class="form-control" id="price" placeholder="Price" step="0.01" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                <div class="col-sm-10">
                    <input type="number" name="stock" class="form-control" id="stock" placeholder="Stock">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="image" class="col-sm-2 col-form-label">Product Image</label>
                <div class="col-sm-10">
                    <input type="file" name="image" class="form-control" id="image" required onchange="previewImage(event)">
                    
                    <div id="imagePreviewContainer" class="mt-3" style="display: none;">
                        <img id="imagePreview" src="#" alt="Image Preview" style="max-height: 100px; width: auto;">
                    </div>
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Create Product</button>
                </div>
            </div>
        </form>
    </div>

<script>  

    window.onload = function() {
        document.getElementById('name').focus(); 
    }


    function generateProductId() {

        const productName = document.getElementById('name').value.trim();

        if (productName === "") {
            document.getElementById('product_id').value = ""; 
            return;
        }

        const firstWord = productName.split(' ')[0];

        const randomNumber = Math.floor(1000 + Math.random() * 9000);  

        const productId = firstWord.toUpperCase() + '-' + randomNumber;

        document.getElementById('product_id').value = productId;
    }

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var imagePreview = document.getElementById('imagePreview');
            var imagePreviewContainer = document.getElementById('imagePreviewContainer');
            
            imagePreview.src = reader.result;

            imagePreviewContainer.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection

@section('scripts')
<script>        
</script>
@endsection
