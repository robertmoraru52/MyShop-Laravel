<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class CategoryAdminController extends Controller
{
    public function __construct(Category $category,Request $request)
    {
        $this->category = $category;
        $this->request = $request;
        $this->product = Product::all();

    }


    public function viewAdminCategory(){
        $categories=Category::all(); 
        $product = Product::all();
       
        return view('admin.category_admin',compact('categories','product'));
    }

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
    
            return back()->with('error',$e);
        }
    }   

    public function deleteCategory(Request $request){
        try{
            $categories=Category::find($request->cat_id); 
            $categories->products()->detach();
            $categories->delete();

            return redirect('admin-category');
            }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error',$e);
          }

    }

    public function editCategory(){
        $this->request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);

        try{
            $this->category::where('id', '=', $this->request->category_id)
                ->update([
                    'name' => $this->request->name,
            ]);
            
            return redirect('admin-category');
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error',$e);
          }

    }

    public function searchAdminCategory(){
        $this->request->validate([
            'search' => 'required|min:3',
        ]);
        try{
            $data = Category::select()
            ->where("name","LIKE","%{$this->request->search}%")
            ->get();
    
            return view('admin.category_admin',['categories' => $data],['product' => $this->product]);
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error',$e);
          }

    }

}
