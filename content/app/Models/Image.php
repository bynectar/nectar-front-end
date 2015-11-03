<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {

  protected $table = 'images';
  protected $fillable = ['title', 'description', 'path'];
    
	public function flower(){
		
		return $this->belongsTo('App\Models\Flower');

	}
	
}
