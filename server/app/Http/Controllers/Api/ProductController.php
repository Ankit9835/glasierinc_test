<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json([
            'status' => true,
            'message' => 'Products fetched successfully',
            'data' => $products
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'category_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required',
            'product_quantity' => 'required',
            'product_details' => 'required',
            'selling_price' => 'required',
        ]);
   
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation failed',
                'data' => $validator->errors()
            ]);     
        }
   
        $product = Product::create($input);
        return response()->json([
            'status' => true,
            'message' => 'Product created successfully',
            'data' => $product
        ]);
       
    } 

    public function show($id)
    {
        $product = Product::find($id);
  
        if (is_null($product)) {
            return response()->json([
                'status' => false,
                'message' => 'product not found',
            ]);   
        }
   
        return response()->json([
            'status' => true,
            'message' => 'product fetched',
            'data' => $product
        ]);   
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'category_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required',
            'product_quantity' => 'required',
            'product_details' => 'required',
            'selling_price' => 'required',
        ]);
   
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation failed',
                'data' => $validator->errors()
            ]);          
        }

        $product = Product::find($id);
       // dd($product);
   
        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->product_code = $request->product_code;
        $product->product_quantity = $request->product_quantity;
        $product->product_details = $request->product_details;
        $product->selling_price = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->status = $request->status;
        $product->save();

        return response()->json([
            'status' => true,
            'message' => 'Product updated successfully',
            'data' => $product
        ]);  
   
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
   
        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully',
            'data' => $product
        ]); 
    }
    
    public function filterCategory($id){
       
        $product = Product::with('category')->where('category_id', $id)->get();
        return response()->json([
            'status' => true,
            'message' => 'Product with specific category id fetched',
            'data' => $product
        ]);  
    }

    public function priceLowToHigh(Request $request){
        $min_price = $request->min_price;
        $max_price = $request->max_price;
       // dd($max_price);
        $product = Product::whereBetween('discount_price', [$min_price, $max_price])->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Product with specific price fetched',
            'data' => $product
        ]);  
    }

    public function priceHighToLow(Request $request){
        $min_price = $request->min_price;
        $max_price = $request->max_price;
       // dd($max_price);
        $product = Product::whereBetween('discount_price', [$max_price, $min_price])->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Product with specific price fetched',
            'data' => $product
        ]);  
    }

    public function orders(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'id' => 'required',
        ]);
   
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation failed',
                'data' => $validator->errors()
            ]);          
        }
        $user = User::with('orders')->where('id',$input['id'])->get();
        return response()->json([
            'status' => true,
            'message' => 'Order fetched',
            'data' => $user
        ]);  
    }
}
