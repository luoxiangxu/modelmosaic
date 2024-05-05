<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\item_table;
use Illuminate\Support\Facades\Storage;
use App\Models\purchase_record;

class StripeController extends Controller
{

    public function stripe($id)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $item = item_table::findOrFail($id);
        $item_name = $item->item_name;
        $price = $item->price;
        $two0 = "00";
        $total = "$price$two0";

        $response = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'USD',
                        'product_data' => ['name' => $item_name],
                        'unit_amount' => $total,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success'). '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cancel'),
        ]);
        if(isset($response->id) && $response->id != ''){
            session()->put('item_id', $item->id);
            return redirect($response->url);
        }else{
            return redirect()->back()->with('error','Invaild Credential');
        }
    }

    public function success(Request $request)
    {
        if(isset($request->session_id)){
            $stripe = new \Stripe\StripeClient(config('stripe.sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);

            $item_id = session()->get('item_id');
            $item = item_table::findOrFail($item_id);
            $item_name = $item->file;

            date_default_timezone_set("Asia/Yangon");
            $purchase_date = date("Y-m-d h:i:sa");
            $purchase_record = new purchase_record();
            $purchase_record->user_id = auth()->user()->id;
            $purchase_record->item_id = $item_id;
            $purchase_record->user_name = auth()->user()->name;
            $purchase_record->item_name = $item->item_name;
            $purchase_record->price = $item->price;
            $purchase_record->image = $item->image;
            $purchase_record->currency = $response->currency;
            $purchase_record->payment_email = $response->customer_details->email;
            $purchase_record->payment_method = "Stripe";
            $purchase_record->payment_status = $response->status;
            $purchase_record->purchase_date = $purchase_date;
            $purchase_record->save();

            return Storage::download('/public/models/' .$item_name);
            session()->forget('item_id');
        }else{
            return redirect()->route('cancel');
        }
    }

    public function cancel()
    {
        return "payment cancel";
    }
}
