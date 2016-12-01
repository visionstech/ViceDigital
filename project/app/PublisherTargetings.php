<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublisherTargetings extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = ['publisher_id','key', 'value', 'date_created', 'updated_by', 'updated_ip'];
	
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
