<?php
namespace App\Http\Controllers;

use App\Models\Product;

class ProductsController extends Controller
{
    /**
     * Return view Details with required product searched by id
     */
    public function viewProductDetails($id)
    {
     

        return view("details", [
            'products' => Product::where('id', '=', $id)->first(),
        ]);
    }
}