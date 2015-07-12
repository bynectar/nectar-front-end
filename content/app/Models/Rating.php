<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model {

	use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'ratings';
    protected $dates = ['deleted_at'];
    protected $fillable = ['rating','user_id','review_id'];
    
	public function review(){
		
		return $this->belongsTo('App\Models\Review');

	}
	
	public function user(){
		
		return $this->belongsTo('App\User');

	}
	
}
