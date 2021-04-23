<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
<<<<<<< Updated upstream
=======
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserOrdersResource;
>>>>>>> Stashed changes

class OrderController extends Controller
{
    public function inject_order($id, $products)
    {
        $order_products = array();
        foreach ($products as $product) {
            $product['order_id'] = $id;
            $order_products[] = $product;
        }
        return $order_products;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = $request->input('order');
        $newOrder = Order::create($order);

        $products = $request->input('products');

        $order_products = array();
        foreach ($products as $product) {
            $product['order_id'] = $newOrder->id;
            $order_products[] = $product;
        }
        $newProducts = OrderProduct::insert($order_products);
        return $newProducts;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
<<<<<<< Updated upstream
=======

    public function latest_order($id)
    {
        $order = Order::where('user_id',$id)->orderBy('created_at', 'DESC')->first();
        return ProductResource::collection($order->products->take(5));
    }

    public function user_orders(Request $request,$id)
    {
        $orders = Order::where('user_id',$id)->where('created_at','>',$request->from)->where('created_at','<',$request->to)->get();
        return $orders;
    }
>>>>>>> Stashed changes
}
