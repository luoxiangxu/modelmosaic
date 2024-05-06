<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user_comment_table;
use Illuminate\Support\Facades\DB;

class UserCommentTableController extends Controller
{
    public function get_comments()
    {
        $item_id = session()->get('comment_item_id');
        $comments = user_comment_table::where('item_id', $item_id)->orderBy('commented_date','desc')->paginate(5);
        return $comments;
    }

    public function post_comment(Request $request)
    {
        $this->validate($request,[
            'comment' => 'required',
        ]);

        $user_id = auth()->user()->id;
        $user_name = auth()->user()->name;
        $item_id = session()->get('comment_item_id');

        $check = DB::table('purchase_records')->where('user_id', $user_id)->where('item_id', $item_id)->count();
        if($check > 0)
        {
            date_default_timezone_set("Asia/Yangon");
            $comment_date = date("Y-m-d h:i:sa");
            $comment = new user_comment_table();
            $comment->user_id = $user_id;
            $comment->item_id = $item_id;
            $comment->user_name = $user_name;
            $comment->comment = $request->comment;
            $comment->commented_date = $comment_date;
            $comment->save();
        }else{
            return response()->json([
                'status' => 'error',
                'msg'    => 'Error',
            ], 400);
        }

    }
}
