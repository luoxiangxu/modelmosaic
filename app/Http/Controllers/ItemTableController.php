<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\item_table;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\DB;

class ItemTableController extends Controller
{
    public function item_detail($data)
    {
        $item = item_table::findOrFail($data);
        return view('user.item_detail', compact("item"));
    }

    public function item_add(Request $request)
    {
        $this->validate($request,[
            'item_name' => 'required',
            'price' => 'required|Integer',
            'description' => 'required',
            'image' => 'required',
        ]);
            $manager = new ImageManager(new Driver());
            $img = $manager->read($request->image);
            $name_gen = rand().'.'.explode('/',explode(':', substr($request->image,0,strpos($request->image, ';')))[1])[1];

            $img->toPng()->save(public_path('images/').$name_gen);
            date_default_timezone_set("Asia/Yangon");
            $added_date = date("Y-m-d h:i:sa");
            item_table::create([
                'item_name'=>$request->item_name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $name_gen,
                'added_date' => $added_date,
            ]);
        }

        public function get_items()
        {
            $items = DB::table('item_tables')->orderBy('id', 'desc')->paginate(5);
            return $items;
        }

    }
