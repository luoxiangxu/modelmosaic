<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\item_table;

class StripeController extends Controller
{

    public function session($id)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $item = item_table::findOrFail($id);
        $item_name = $item->item_name;
        $price = $item->price;
        $two0 = "00";
        $total = "$price$two0";

        $session = \Stripe\Checkout\Session::create([
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
            'success_url' => route('purchase_record'),
            'cancel_url' => route('home'),
        ]);

        return redirect()->away($session->url);
    }
}
