<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\purchase_record;

class PurchaseRecordController extends Controller
{
    public function get_purchase_record()
    {
        $user_id = auth()->user()->id;
        $items = purchase_record::where('user_id', $user_id)->orderBy('purchase_date','desc')->paginate(10);
        return $items;
    }

    public function user_search_purchase_record()
    {
        if($search = \Request::get('q')){
            $items = purchase_record::where([
                ['item_name','LIKE', "%$search%"],
            ])->orderBy('created_at', 'desc')->paginate();
        }else{
            $items = DB::table('purchase_record')->orderBy('purchase_date', 'desc')->paginate(10);
        }
        return $items;
    }
}
