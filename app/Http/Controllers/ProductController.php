<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::where('is_available', 1)->paginate();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate data
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products|min:3',
            'price' => 'required|integer|min:3',
            "category_id" => 'required',
            "image" => 'required'
        ]);
        // check validator
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 200);
        } else {
            $product = new Product();
            // upload image
            if ($request->hasFile("image")) {
                $file = $request->file('image');
                $name = 'products/' . uniqid() . '.' . $file->extension();
                $file->storePubliclyAs('public', $name);
                $product->image =  asset('storage/' . ($name));
            }

            $product->name = $request->name;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            return $product->save() ?
                response()->json(['status' => "success", 'data' => $product], 200) :
                response()->json(['status' => "error", 'message' => 'request failed'], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->category = $product->category;
        return response()->json(["status" => "success", "data" => $product], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|min:3',
            'price' => 'integer|min:3',
            'is_available' => 'boolean'
        ]);
        // check validator
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 200);
        } else {
            if ($request->hasFile("image")) {
                $file = $request->file('image');
                $name = 'products/' . uniqid() . '.' . $file->extension();
                $file->storePubliclyAs('public', $name);
                $product->image =  asset('storage/' . ($name));
            }
            $product->name = $request->name ? $request->name : $product->name;
            $product->price = $request->price ? $request->price : $product->price;
            $product->is_available = $request['is_available'] != null ? $request->is_available  : $product->is_available;
            return $product->update() ?
                response()->json(["status" => "success", "data" => $product], 200) :
                response()->json(['status' => "error", "message" => "request failed"], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        return $product->delete() ?
            response()->json(['status' => "success", "message" => "product deleted succssfully"], 200) :
            response()->json(['status' => "error", 'message' => 'request failed'], 403);
    }
    
}
