<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flower extends Model {

  protected $table = 'flowers';
  protected $fillable = [
    'common_name_1',
    'common_name_2',
    'common_name_3',
    'latin_name',
    'description',
    'colors',
    'branches',
    'berries',
    'foliage',
    'spring',
    'summer',
    'fall',
    'winter'
  ];
    
	public function image(){
		
		return $this->hasMany('App\Models\Image');

	}
	
}