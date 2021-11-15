<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderAdminController extends Controller
{
    public function viewAdminTable(){
        return view('admin.data_table');
    }

     /**
     * Return Admin orders table with collection Orders
     */
    public function viewAdminOrder(){
        $orders = Order::paginate(5);

        return view('admin.order_admin',compact('orders'));
    }

     /**
     * Edit orders info
     */
    public function editOrder(Request $request){
        $request->validate([
            'name' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable',
            'order_id' => 'required',
        ]);
        try{
            $order = new Order();
            $order->where('id', '=', $request->order_id)
            ->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
        ]);

        return redirect('admin-order');
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error','There was an error');
          }
    }

     /**
     * Delete order by id from Admin category page
     */
    public function deleteOrder(Request $request){
        try{
            $order=Order::find($request->order_id); 
            $order->products()->detach();
            $order->delete();

            return redirect('admin-order');
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error','There was an error');
          }

    }
}
