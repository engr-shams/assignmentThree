<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller{

    public function index(Request $request){

    $search = $request->input('search');    

    $sortBy = $request->input('sort_by', 'name');
    $direction = $request->input('direction', 'asc');    

    $query = Product::query();

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('product_id', 'like', "%{$search}%")
              ->orWhere('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('price', 'like', "%{$search}%");
        });
    }

    $query->orderBy($sortBy, $direction);

    $products = $query->paginate(5); 

    return view('products.index', compact('products'));
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
    $request->validate([
        'product_id' => 'required|unique:products',
        'name' => 'required',
        'description' => 'nullable',
        'price' => 'required|numeric',
        'stock' => 'nullable|integer',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image');

        $imageName = time() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images'), $imageName);
    }

    Product::create([
        'product_id' => $request->product_id,
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'image' => 'images/' . $imageName, 
    ]);

    return redirect()->route('products.index')->with('success', 'Product created successfully!');

    }

    public function show($id){
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id){
    $request->validate([
        'name' => 'required',
        'description' => 'nullable',
        'price' => 'required|numeric',
        'stock' => 'nullable|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
    ]);

    $product = Product::findOrFail($id);

    if ($request->hasFile('image')) {
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $image = $request->file('image');

        $imageName = time() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images'), $imageName);

        $product->image = 'images/' . $imageName;
    }

    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->stock = $request->stock;

    $product->save();

    return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id){

    $product = Product::findOrFail($id);

    if ($product->image && file_exists(public_path($product->image))) {
        unlink(public_path($product->image)); 
    }

    $product->delete();

    return redirect()->route('products.index')->with('success', 'Product and image deleted successfully!');
    }
}
