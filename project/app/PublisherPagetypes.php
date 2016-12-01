<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublisherPagetypes extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = ['publisher_id','title', 'selector','updated_by', 'updated_ip'];
}
