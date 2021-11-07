<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;

class HomepageController extends Controller
{
  /**
  *Return Homepage with Products From DB
  */
    public function homepage(){
      return view('homepage', [
        'products' => Product::leftJoin('ratings', function($join)
        {
            $join->on('ratings.id_product', '=', 'products.id');
        })
        ->paginate(6),
      ]);
    }

    public function categoryFilter(Request $request){
      $request->validate([
        'id' => 'required',
      ]);

      $category = Category::find($request->id);
      return view('homepage',['products' => $category->products()->paginate(6)]);
    }

    public function accountView(){
      return view('account');
    }

    /**
     * Stores In DB Ratings of Products
     */
    public function starRating(Request $request){
      $rating = new Rating();
      $checkRating = Rating::where('id_product', $request->id)
      ->where('user_email', Auth::user()->email)
      ->first();

      if($checkRating == null){
        $rating->id_product = $request->id;
        $rating->stars = $request->star;
        $rating->user_email = Auth::user()->email;
        $rating->save();
      }
      else{
        Rating::where('id_product', $request->id)
        ->where('user_email', Auth::user()->email)
        ->update(['stars' => $request->star]);
      }
    }
}
