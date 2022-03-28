<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderdetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $count_order = Order::where('user_id', Auth::id())->where('status', 0)->count();
        if($count_order > 0) {
            $order = Order::where('user_id', Auth::id())->where('status', 0)->first();
            $count_orderdetails = Orderdetail::where('order_id', $order->id)->count();
            if($count_orderdetails > 0) {
                $data = Orderdetail::all()->where('order_id', $order->id);
                $orderdetails = array();
                foreach($data as $item) {
                    array_push($orderdetails, $item);
                }
                return view('orderdetails.index', compact('orderdetails'));
            }
        }
        return view('orderdetails.index')->with('orderdetails', '');
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
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $orderdetails = Orderdetail::find($id);
        $orderdetails->amount -= $request->minus;
        $orderdetails->save();

        if($orderdetails->amount == 0) {
            $orderdetails->delete(['id', $orderdetails->id]);
        }

        $order = Order::find($orderdetails->order_id);
        $order->total -= $orderdetails->product->price;
        $order->save();
        
        return redirect(route('orderdetails.index'));
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
}
