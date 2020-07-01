<?php

namespace App\Http\Controllers;

use DB;
use Log;
use App\User;
use App\Order;
use App\PizzasOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
      $histories = DB::table('pizzas')
        ->join('pizzas_orders', 'pizzas.id', '=', 'pizzas_orders.product_id')
        ->join('orders', 'pizzas_orders.order_id', '=', 'orders.id')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select('pizzas.id as pizza_id', 'pizzas.name as pizza_name', 'pizzas.size as pizza_size', 'pizzas.image',
            'pizzas_orders.quantity', 'pizzas_orders.total_price_dollar as dollar_price', 'pizzas_orders.total_price_euro as euro_price', 'users.name as user_name')
        ->where('users.id', '=', Auth::id())
        ->get();

      return view('history', ['histories' => $histories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $postalCode = $request->input('postalCode');
        $address = $request->input('address');
        $dollarPrice = $request->input('dollarPrice');
        $euroPrice = $request->input('euroPrice');
        $cart = $request->input('cart');
        $quantities = $request->input('quantities');
        //$4.95 | €2.3 ---deliveryFee
        try{
            DB::beginTransaction();
            $order = new Order();
            $order->user_id = Auth::id();
            $order->no_item = count($cart);//seleted index quantities
            $order->price_euro = $euroPrice * 2.3;
            $order->price_dollar = $dollarPrice * 4.95;
            $order->address = $address;
            $order->postal_code = $postalCode;
            $orderId = $order->save();

            for($i=0; $i < count($cart); $i++){
              //for loop here from cart
              $pizzaOrder = new PizzasOrder();
              $pizzaOrder->order_id = $orderId;
              $pizzaOrder->product_id = $cart[$i]['id']; //selected index product id
              $pizzaOrder->quantity = $quantities[$i]; //selected index quantity
              $pizzaOrder->total_price_dollar = $cart[$i]['price_dollar'] * $quantities[$i];
              $pizzaOrder->total_price_euro =  $cart[$i]['price_euro'] * $quantities[$i];
              $pizzaOrder->save();
            }
            DB::commit();
            return response()->json(['message' => 'Success'],201);
        }catch(\Exception $e){
          return response()->json(['message' => $e->getMessage()], 500);
        }

    }
}
