<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class poductController extends Controller
{

    public function create()
    {
        $category = Category::get();
       
        return view('admin.create', compact('category'));
    }

    public function index(){
        $products = Product::with('category')->get();
        return view('admin.index', compact('products'));
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "category" => "required",
            "name" => "required",
            'image' => 'required',
        ], [
            "category" => "Category is Empty",
            "name" => "Product name is Empty",
            "image" => "image is Empty",
        ]);

        if ($validate->passes()) {
            $product = new Product;
            $product->cat_id= $request->category;
            $product->name = $request->name;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = $image->getClientOriginalName();
                $image->move('admin_assets/uploads/', $filename);
                $product->image = $filename;
            }
            $product->save();
            return response()->json([
                'status' => true,
                'errors' => $validate->errors()
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validate->errors()
            ]);
        }
    }
    public function edit($id){
        $product = Product::find($id);
        $category = Category::get();
        return view('admin.edit', compact('product', 'category'));
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            "category" => "required",
            "name" => "required",
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            "category.required" => "Category is required",
            "name.required" => "Product name is required",
            "image.image" => "The file must be an image",
            "image.mimes" => "Allowed image types: jpeg, png, jpg, gif",
            "image.max" => "Image size must be under 2MB",
        ]);
    
        if (!$validate->passes()) {
            return response()->json([
                'status' => false,
                'errors' => $validate->errors(),
            ]);
        }
    
        $product = Product::find($id);    
        $product->cat_id = $request->category;
        $product->name = $request->name;
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $image->move('admin_assets/uploads/', $filename);
            $product->image = $filename;
        }
    
        $product->save(); 
    
        return redirect()->route('index')->with('success', 'Product updated successfully!');
    }
    public function delete($id) {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('index')->with('success', 'Product deleted successfully!');
    }
}
