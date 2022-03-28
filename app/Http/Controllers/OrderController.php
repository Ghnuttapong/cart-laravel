<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $count_order = Order::where('user_id', Auth::id())->where('status', 0)->count();  
        $order = Order::where('user_id', Auth::id())->where('status', 0)->first();     
        if($count_order == 0) {
            $prepareOrder = [
                'user_id' => Auth::id(),
                'status' => 0,
            ];
            $order = Order::create($prepareOrder);
        }

        $count_orderdetail = Orderdetail::where('product_id', $request->product_id)->where('order_id', $order->id)->count();
        $orderdetail = Orderdetail::where('product_id', $request->product_id)->where('order_id', $order->id)->first();  
        if($count_orderdetail == 0) {
            $prepareOrderdetail = [
                'order_id' => $order->id,
                'product_id' => $request->product_id,  
                'amount' => 1
            ];
            $orderdetail = Orderdetail::create($prepareOrderdetail);
        }else { 
            $orderdetail->amount = $orderdetail->amount + 1;
            $orderdetail->save();
        }

        $order->total += $orderdetail->product->price;
        $order->save();

        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
        $order->status = 1;
        $order->save();
        return redirect(route('payments.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
