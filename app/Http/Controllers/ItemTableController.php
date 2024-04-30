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
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required',
        ]);
            $manager = new ImageManager(new Driver());
            $img = $manager->read($request->image);
            $name_gen = rand().'.'.explode('/',explode(':', substr($request->image,0,strpos($request->image, ';')))[1])[1];
            $img->toPng()->save(public_path('images/').$name_gen);

            date_default_timezone_set("Asia/Yangon");
            $added_date = date("Y-m-d h:i:sa");
            $status = 'available';
            item_table::create([
                'item_name'=>$request->item_name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $name_gen,
                'added_date' => $added_date,
                'status' => $status,
            ]);
        }

        public function get_items()
        {
            $items = DB::table('item_tables')->orderBy('id', 'desc')->paginate(10);
            return $items;
        }

        public function edit_item(Request $request)
        {
            $this->validate($request,[
                'item_name' => 'required',
                'price' => 'required|numeric',
                'description' => 'required',
                'image' => 'Sometimes',
            ]);

            $item = item_table::findOrFail($request->id);
            $item->item_name = $request->item_name;
            $item->price = $request->price;
            $item->description = $request->description;

            if(isset($request->edit_image)){
                $image_path = public_path('images/').$item->image;
                @unlink($image_path);
                $manager = new ImageManager(new Driver());
                $img = $manager->read($request->edit_image);
                $name_gen = rand().'.'.explode('/',explode(':', substr($request->edit_image,0,strpos($request->edit_image, ';')))[1])[1];
                $img->toPng()->save(public_path('images/').$name_gen);
                $item->image = $name_gen;
                $item->save();
            }else{
                $item->save();
            }
            
        }

        public function item_delete(Request $request)
        {
            $item = item_table::findOrFail($request->id);
            $item->status = 'deleted';
            $item->save();
        }

        public function item_restore(Request $request)
        {
            $item = item_table::findOrFail($request->id);
            $item->status = 'available';
            $item->save();
        }

    }
