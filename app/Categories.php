<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model {
  
  protected $table =  env('DB_TABLE_PREFIX', '').categories';
  protected $primaryKey = 'id';
  
  //Some additional Model code
  
}
