<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Cart;

class Emporter extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('emporter.emporterMenu', compact('menus'));
    }

    public function store(Request $request)
    {

        $menus = Menu::findOrFail($request->input('product_id'));
        Cart::add(
            $menus->id,
            $menus->name,
            $request->input('quantity'),
            $product->price / 100,
        );


        return view('emporter.emporterMenu', compact('menus'))->with('message', 'Successfully added');

        // return redirect()->route('products.index')->with('message', 'Successfully added');
    }
}
