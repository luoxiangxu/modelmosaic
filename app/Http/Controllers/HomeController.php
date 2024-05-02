<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\item_table;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $items = item_table::where('status','available')->orderBy('created_at','desc')->get();
        return view('welcome', compact("items"));
    }
}
