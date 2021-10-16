<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductsController extends Controller
{
    public function viewProductDetails(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        return view('details', [
            'products' => DB::table('products')->where('id', '=', $request->id)->first(),
        ]);
    }
}
