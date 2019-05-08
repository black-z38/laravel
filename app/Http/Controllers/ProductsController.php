<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    /**
     * Show the application Product operation AND List.
     *
     * @return /view/panel/list
     */
    public function list()
    {
        /* get products */
        $product = Product::all();
        $quantity_in_stock_total = 0;
        $price_per_item_total = 0;
        $total_value_number_total = 0;
        /* add total field and calculator */
        foreach ($product as $key => $value){
            $quantity_in_stock_total += $value->quantity_in_stock;
            $price_per_item_total += $value->price_per_item;
            $total_value_number_total += $value->quantity_in_stock * $value->price_per_item;
            $product[$key]['total_value_number'] = $value->quantity_in_stock * $value->price_per_item;
        }
        /* total of item */
        $total = array(
            'quantity_in_stock_total' => $quantity_in_stock_total,
            'price_per_item_total' => $price_per_item_total,
            'total_value_number_total' => $total_value_number_total,
        );


        /* set table column */
        $label = array('id', 'product_name', 'quantity_in_stock', 'price_per_item', 'created_at', 'total_value_number');

        /*return data to view*/
        return view('products', array('data' => $product, 'label' => $label, 'total' => $total));
    }

    public function store(Request $request)
    {
//----  insert new product
        if(!$request->pro_id){
            $product = new Product();
            $product->product_name = $request->product_name;
            $product->quantity_in_stock = $request->quantity_in_stock;
            $product->price_per_item = $request->price_per_item;
            $product->save();
        } else {
            $product = Product::where('id', $request->pro_id)->first();
            $product->product_name = $request->product_name;
            $product->quantity_in_stock = $request->quantity_in_stock;
            $product->price_per_item = $request->price_per_item;
            $product->save();
        }

    }
}
