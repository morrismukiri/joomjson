<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model {
	public function __construct()
	{
		$this->table = env('DB_TABLE_PREFIX', '').'content';
	}
  protected $table;
  protected $primaryKey = 'id';

  
}