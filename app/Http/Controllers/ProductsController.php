<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    /**
     * Return view Details with required product searched by id
     */
    public function viewProductDetails(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        return view('details', [
            'products' => Product::where('id', '=', $request->id)->first(),
        ]);
    }
}