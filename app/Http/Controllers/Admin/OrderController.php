<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('products', 'sales')->paginate();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $data = $request->all();
        $data['identify'] = '#' . rand();
        $data['code'] = '#' . rand();
        $order_id = Order::create($data)->id;
       
        for($i = 0; $i < count($request->product_id); $i++){
            $sale = Sale::create([
                'order_id' => $order_id,
                'product_id' => $request->product_id[$i],
                'price' => $request->price[$i],
                'qty' => $request->qty[$i]
            ]);
        }

        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$order = Order::with('sales')->find($id)){
            return redirect()->back();
        }
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if (!$order = Order::find($id)) {
            return redirect()->back();
        }
        return view('admin.orders.edit', compact('order'));
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
        if (!$order = Order::find($id)) {
            redirect()->back();
        }
        $order->update($request->all());
        return redirect()->route('orders.index');
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

    public function search(Request $request)
    {
        $data = $request->except('_token');
        $orders = Order::where(function ($query) use ($request) {
            if ($request->identify) {
                $query->where('identify', 'LIKE', "%{$request->identify}%");
            }
            if ($request->payment_method) {
                $query->orWhere('payment_method', $request->payment_method);
            }
            if ($request->status) {
                $query->where('status', $request->status);
            }
        })
            ->orderBy('date', 'asc')
            ->paginate();

        return view('admin.orders.index', compact('orders', 'data'));
    }

    public function showProductOrder($id)
    {
        if(!$orders = Order::find(218)){
            return redirect()->back();
        }
        return response()->json($orders->products);
        //
    }
}
