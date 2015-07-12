<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {

	use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'reviews';
    protected $dates = ['deleted_at'];
    protected $fillable = ['title', 'content','user_id','thing_id'];
    
	public function category_id(){
		
		return $this->hasOne('App\Models\Category');

	}
	
	public function rating(){
		
		return $this->hasOne('App\Models\Rating');

	}
	
	public function thing(){
		
		return $this->belongsTo('App\Models\Thing');

	}
	
	public function flags(){
		
		return $this->hasMany('App\Models\Flag');

	}
	
	public function votes(){
		
		return $this->hasMany('App\Models\Vote');

	}
	
//	public function votes_count(){
		
//		return $this->votes()->count();

//	}
	
	public function comments(){
		
		return $this->hasMany('App\Models\Comment');

	}
	
	public function user(){
		
		return $this->belongsTo('App\User');

	}
	
}
