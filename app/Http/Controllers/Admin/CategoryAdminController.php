<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class CategoryAdminController extends Controller
{
    /**
     * Returns Admin category page with 2 collections
     */
    public function viewAdminCategory(){
        $categories=Category::all(); 
        $product = Product::all();
       
        return view('admin.category_admin',compact('categories','product'));
    }

    /**
     * Add category to Admin category page
     */
    public function addCategory(Request $request){
        $request->validate([
            'name' => 'required',
            'product' => 'required',
        ]);
        try{         
            $categories=Category::all(); 
            $data = $request->all();
            $categories = Category::create($data);
            $categories->products()->sync($request->product);

            return redirect('admin-category');
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error','There was an error');
        }
    }   

    /**
     * Delete category from Admin category page
     */
    public function deleteCategory(Request $request){
        try{
            $categories=Category::find($request->cat_id); 
            $categories->products()->detach();
            $categories->delete();

            return redirect('admin-category');
            }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error','There was an error');
          }

    }

     /**
     * Edit category from Admin category page
     */
    public function editCategory(Request $request){
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);
        try{
            Category::where('id', '=', $request->category_id)
                ->update([
                    'name' => $request->name,
            ]);
            
            return redirect('admin-category');
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error','There was an error');
          }
    }
}
