<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = ['user_id','website', 'status', 'email', 'name', 'overlays', 'infusion', 'dynamic_ads', 'programmatic', 'updated_by', 'updated_ip'];
	
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
