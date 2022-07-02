<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;



class ProductApiController extends Controller
{

    

    public function index()
    {
        $products = Product::all()->toArray();
        return array_reverse($products);      
    }
    public function store(Request $request)
    {
        $product = new Product([
            'sku' => $request->input('sku'),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'availability' => $request->input('availability'),
            'discount' => $request->input('discount'),
            'image' => $request->input('image|mimes:jpeg,png,jpg|max:2048'),
        ]);
        if($request->image) {         	
            $name = uniqid().'.'.$request->image->extension();           	
            $request->image->move(public_path('images/products'), $name);         
            $product->image = $name;     	
            }    	
            
        $product->save();
       
    }
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }
    public function update($id, Request $request)
    {
        $product = Product::find($id);
        $product->update($request->all());
        if($request->image) {         	
            $name = uniqid().'.'.$request->image->extension();           	
            $request->image->move(public_path('images/products'), $name);         
            $product->image = $name;     	
        }    	
        return response()->json('Product updated!');
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json('Product deleted!');
    }
}
