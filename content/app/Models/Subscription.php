<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model {

    protected $table = 'subscriptions';
    protected $fillable = ['thing_id','category_id','author_id','user_id'];
    
	public function thing(){
		
		return $this->belongsTo('App\Models\Thing');

	}
	
	public function category(){
		
		return $this->belongsTo('App\Models\Category');

	}
	
	public function author(){
		
		return $this->belongsTo('App\User');

	}
	
	public function user(){
		
		return $this->belongsTo('App\User');

	}
	
}
