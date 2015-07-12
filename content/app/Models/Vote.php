<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model {

    protected $table = 'votes';
    protected $fillable = ['review_id','thing_id','category_id','user_id'];
    
	public function review(){
		
		return $this->belongsTo('App\Models\Review');

	}
	
	public function thing(){
		
		return $this->belongsTo('App\Models\Thing');

	}
	
	public function category(){
		
		return $this->belongsTo('App\Models\Category');

	}
	
	public function user(){
		
		return $this->belongsTo('App\User');

	}
	
}
