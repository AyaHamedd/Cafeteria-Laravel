<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderProduct;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderPriceResource;
use App\Http\Resources\OrderProductsResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserOrdersResource;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('status', 'processing')->with('room','user','products')->orderBy('created_at', 'DESC')->paginate(2);
        return OrderResource::collection($orders);
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
        $order = Order::find($id);
        $order->status = 'delivering';
        $order->save();
        return response()->json('order updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroyedOrder = Order::find($id)->delete();
        if ($destroyedOrder) {
            return response('Order Deleted successfully', 200)
                  ->header('Content-Type', 'text/plain');
        } else {
            return response('Error', 404)
            ->header('Content-Type', 'text/plain');
        }
    }

    public function orderPrice($id){
        $total_price = Order::find($id)->getTotalOrderPrice();
        return $total_price;
    }

    public function userTotalPrice($userId, $dateFrom, $dateTo){
        $returnedObject=[];
        $selectedUser = User::find($userId);
        $selectedUserOrders = $selectedUser->orders
        ->where('created_at','>',$dateFrom)
        ->where('created_at','<',$dateTo);
        if(count($selectedUserOrders)!==0){
            $totalUserOrdersPrice = 0;
            foreach($selectedUserOrders as $selectedUserOrder){
                $totalUserOrdersPrice += $selectedUserOrder->getTotalOrderPrice();         
            }
            return ['id'=>$selectedUser->id, 'user'=>$selectedUser->name, 'total_orders_price'=>$totalUserOrdersPrice];
        }
        return;
    }

    public function searchOrderUsersByDate(Request $request){
        $userId = $request->selected_user_id;
        if($userId > 0){
            return $this->userTotalPrice($userId, $request->date_from, $request->date_to);
        }
        else{
            $allUsers = User::all();
            $usersPrices = [];
            foreach($allUsers as $user){
                if($user->is_admin !== 1){
                    $oneUserPrice = $this->userTotalPrice($user->id, $request->date_from, $request->date_to);
                    if($oneUserPrice !== null){
                        array_push($usersPrices, $oneUserPrice);
                    }
                }
            }
            return $usersPrices;
        }
    }

    public function searchOrdersByDate(Request $request, $userId){
        $selectedUser = User::find($userId);
        $selectedUserOrders = $selectedUser->orders
        ->where('created_at','>',$request->dateFrom)
        ->where('created_at','<',$request->dateTo);
        return OrderPriceResource::collection($selectedUserOrders);
        return ['id'=>$selectedUserOrders->id, 
        'created_at'=>$selectedUserOrders->created_at, 
        'order_price'=>$selectedUserOrders->getTotalOrderPrice()];
    }

    public function latest_order($id)
    {
        $order = Order::where('user_id',$id)->orderBy('created_at', 'DESC')->first();
        return ProductResource::collection($order->products->take(5));
    }

    public function user_orders(Request $request,$id)
    {
        $orders = Order::where('user_id',$id)->where('created_at','>',$request->from)->where('created_at','<',$request->to)->orderBy('created_at', 'DESC')->paginate(4);;
        return UserOrdersResource::collection($orders);
    }

    public function getOrderProducts($orderId){
        $orderProducts = Order::find($orderId)->products;
        return OrderProductsResource::collection($orderProducts);
    }
}
