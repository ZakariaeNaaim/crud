<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;   //kanzido maktaba dial soft

class Product extends Model
{
    use SoftDeletes;
   protected $fillable = ['name','price','detail'];
   protected $dates = ['deleted_at'];  //bach ya3raf delete ghadar 3an tariq softdelete
}
