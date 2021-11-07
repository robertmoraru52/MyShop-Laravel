<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\Category;

class SearchController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Autofill Search Bar Homepage
     */
    public function autocomplete()
    {
        try{
        $data = Product::select("name")
                ->where("name","LIKE","%{$this->request->suggestion}%")
                ->get();

        return response()->json($data);
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error',$e);
        }

    }

    /**
     * Autofill Search Admin User
     */
    public function autocompleteAdminUser()
    {
        $data = User::select("email")
                ->where("email","LIKE","%{$this->request->search}%")
                ->get();

        return response()->json($data);
    }

    /**
     * Autofill Search Admin Category
     */
    public function autocompleteAdminCategory()
    {
        $data = Category::select("name")
                ->where("name","LIKE","%{$this->request->search}%")
                ->get();

        return response()->json($data);
    }


    /**
     * Submit Search Navbar 
     */
    public function searchNavBar(){
        $this->request->validate([
            'search' => 'required|min:3'
        ]);
        $data = Product::select()
        ->where("name","LIKE","%{$this->request->search}%")
        ->paginate(6);

        return view('homepage',['products' => $data]);
    }
}
