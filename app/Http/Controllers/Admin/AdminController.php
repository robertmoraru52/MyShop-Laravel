<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\Category;

class AdminController extends Controller
{
    public function viewAdmin(){
        return view('admin.main');
    }

     /**
     * Returns Admin product page with 2 collections
     */
    public function viewAdminProduct(){
        $cat=Category::all(); 
        $products = Product::paginate(5);

        return view('admin.product_admin',compact('cat','products'));
    }

    /**
     * Soft Deleting Products Function
     */
    public function deleteProduct(Request $request){
        try{
            Product::where('id', '=', $request->product_id)->delete();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error','There was an error');
          }

        return redirect('admin-product');
    }

     /**
     * Add products to DB from Admin Product Table
     */
    public function addProduct(Request $request){
        $request->validate([
            'name' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        try{
            Product::create([
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
            'description' => $request->description,
        ]);
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error','There was an error');
          }

        return redirect('admin-product');
    }
    
    /**
     * Edit Products from Admin Product Table
     */
    public function editProduct(Request $request){
        $request->validate([
            'name' => 'nullable',
            'stock' => 'nullable',
            'price' => 'nullable',
            'description' => 'nullable',
            'product_id' => 'required',
        ]);
        try{
            Product::where('id', '=', $request->product_id)
            ->update([
                'name' => $request->name,
                'stock' => $request->stock,
                'price' => $request->price,
                'description' => $request->description,
        ]);

        return redirect('admin-product');
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error','There was an error');
          }
    }
}