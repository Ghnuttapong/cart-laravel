<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index() {
        $products = Product::paginate(4);
        return view('products.index', compact('products'));
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'amount' => 'required',
            'picture' => 'required'
        ]);

        $product = new Product;

        if($request->hasFile('picture')) {
            $file = $request->file('picture');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $path = 'image/products';
            $file->move($path, $filename);
            $fullpath = $path.'/'.$filename;
            $product->picture = $fullpath;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->amount = $request->amount;
            $product->save();
        }

        return redirect(route('products.index'))->with('status', 'Products has been created successfully');
    }

    
    public  function edit(Product $product) {
        return view('products.edit', compact('product'));
    }


    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'amount' => 'required',
        ]);

        $product = Product::find($id);

        if($request->hasFile('picture')) {
            $file = $request->file('picture');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $path = 'image/products';
            $file->move($path, $filename);
            $fullpath = $path.'/'.$filename;
            $product->picture = $fullpath;
        }
        $product->name = $request->name;
        $product->price = $request->price;
        $product->amount = $request->amount;
        $product->save();
        return redirect(route('products.index'))->with('status', 'Product has been updated successfully');
    }

    public function destroy($id) {
        Product::destroy($id);
        return redirect()->back()->with('status', 'Product has been deleted successfully');
    }
}
