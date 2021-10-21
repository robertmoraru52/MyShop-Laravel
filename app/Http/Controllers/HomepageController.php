<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function homepage(){
      return view('homepage', [
        'products' => DB::table('products')
        ->leftJoin('ratings', function($join)
        {
            $join->on('ratings.id_product', '=', 'products.id');
        })
        ->paginate(6)
      ]);
    }

    public function accountView(){
      return view('account');
    }

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
