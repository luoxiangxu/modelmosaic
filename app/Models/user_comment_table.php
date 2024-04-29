<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_comment_table extends Model
{
    use HasFactory;

    protected $guarded= [];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function item()
    {
        return $this->belongsTo('App\item_table');
    }
}


