<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['id','title','subtitle','content', 'category_id','image'];

    public function category(){
        return $this->belongsTo('App\Category');
    }
}
