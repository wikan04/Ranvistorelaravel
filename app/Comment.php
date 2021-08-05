<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = ["users_id","products_id","comment"];


    public function user ()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }
}