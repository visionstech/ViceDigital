<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = ['publisher_id','slotname', 'container', 'positioning', 'mobile_sizes', 'tablet_sizes', 'desktop_sizes', 'lazyload', 'page_type','date_created'];
	
    /**
      * Return column names of publisher table.
      * @param           
      * @return Response
      * Created on: 28/11/2016
      * Updated on: 28/11/2016
    **/
   public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
