<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\Category;
use App\Models\Order;

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
