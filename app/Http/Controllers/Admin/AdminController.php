<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\Category;

class AdminController extends Controller
{
    public function __construct(Product $products, Request $request, Category $category)
    {
        $this->products = $products;
        $this->request = $request;
        $this->category = $category;

    }

    public function viewAdmin(){
        return view('admin.main');
    }

    public function viewAdminProduct(){
        $cat=Category::all(); 
        $products = $this->products->paginate(5);
        return view('admin.product_admin',compact('cat','products'));
    }

    /**
     * Soft Deleting Products Function
     */
    public function deleteProduct(){
        try{
        $this->products->where('id', '=', $this->request->product_id)->delete();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error',$e);
          }

        return redirect('admin-product');
    }

     /**
     * Add products to DB from Admin Product Table
     */
    public function addProduct(){
        $this->request->validate([
            'name' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        try{
        $this->products::create([
            'name' => $this->request->name,
            'stock' => $this->request->stock,
            'price' => $this->request->price,
            'description' => $this->request->description,
        ]);
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error',$e);
          }
        return redirect('admin-product');
    }
    
    /**
     * Edit Products from Admin Product Table
     */
    public function editProduct(){
        $this->request->validate([
            'name' => 'nullable',
            'stock' => 'nullable',
            'price' => 'nullable',
            'description' => 'nullable',
            'product_id' => 'required',
        ]);

        try{
        $this->products::where('id', '=', $this->request->product_id)
            ->update([
                'name' => $this->request->name,
                'stock' => $this->request->stock,
                'price' => $this->request->price,
                'description' => $this->request->description,
        ]);
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error',$e);
          }

        return redirect('admin-product');
    }

    /**
    *Search In Admin Products Table
    */
    public function searchAdminProducts(){
        $this->request->validate([
            'search' => 'required|min:3',
        ]);
        try{
            $data = Product::select()
            ->where("name","LIKE","%{$this->request->search}%")
            ->paginate(5);
    
            return view('admin.product_admin',['products' => $data]);
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error',$e);
          }
    }

    public function changeAdminCategory(){
        $this->request->validate([
            'idCat' => 'required',
            'prodId' => 'required'
        ]);

        try{
            $categories = Category::find( $this->request->idCat);
            if(! $categories->products->contains($this->request->prodId)){
                $categories->products()->syncWithoutDetaching($this->request->prodId);
            }
            else{
                $categories->products()->detach($this->request->prodId);
            }

        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error',$e);
          }
    }
}
