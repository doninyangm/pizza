<?php

namespace App\Http\Controllers;

use App\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PizzaController extends Controller
{

    public function validator(){
      return [
          'name' => 'required',
          'size' => 'required|',
          'price_euro' => 'required',
          'price_dollar' => 'required',
          'description' => 'required'
      ];
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Pizza::all(), 201);
        // return view('pizza.index', ['projects' => $projects], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Pizza::find($id), 201);
    }
}
