<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item_table extends Model
{
    use HasFactory;

    protected $guarded= [];

    public function purchase_records()
    {
        return $this->hasMany('App\purchase_record');
    }

    public function user_comments()
    {
        return $this->hasMany('App\user_comment_table');
    }
}
