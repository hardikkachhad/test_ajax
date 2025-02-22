<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\poductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/create',[poductController::class, 'create'])->name('create');
Route::get('/index',[poductController::class, 'index'])->name('index');
Route::post('/store',[poductController::class,'store'])->name('store');
Route::get('/edit/{id}',[poductController::class, 'edit'])->name('edit');
Route::put('/update/{id}',[poductController::class, 'update'])->name('update');
Route::get('/delete/{id}',[poductController::class, 'delete'])->name('delete');


 // public function store(Request $request)
 //    {
 //        $request->validate([
 //            'name' => 'required|string|max:255',
 //            'category' => 'required|exists:categories,id',
 //            'image' => 'required|image',
 //            'images.*' => 'image',
 //            'hobbies' => 'required|array',
 //            'hobbies.*' => 'string|max:255',
 //        ]);

 //        // Create new product
 //        $product = new product();
 //        $product->category_id = $request->category;
 //        $product->name = $request->name;

 //        // Save single image
 //        $image = $request->file('image');
 //        $filename = time() . '_' . $image->getClientOriginalName();
 //        $image->move(public_path('product/image/'), $filename);
 //        $product->image = $filename;

 //        $product->save();

 //        // Save multiple images (no `if` condition, only `foreach`)
 //        foreach ($request->file('images') as $image) {
 //            $filename = time() . '_' . $image->getClientOriginalName();
 //            $image->move(public_path('products/image/'), $filename);

 //            productimage::create([
 //                'product_id' => $product->id,
 //                'productimage' => $filename,
 //            ]);
 //        }

 //        // Save multiple hobbies (no `if` condition, only `foreach`)
 //        foreach ($request->hobbies as $hobby) {
 //            ProductHobby::create([
 //                'product_id' => $product->id,
 //                'hobby_name' => $hobby,
 //            ]);
 //        }

 //        return redirect()->route('products')->with('success', 'Product created successfully');
 //    }

