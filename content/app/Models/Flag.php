<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flag extends Model {

    protected $table = 'flags';
    protected $fillable = ['type','review_id','thing_id','user_id'];
    
	public function review(){
		
		return $this->belongsTo('App\Models\Review');

	}
	
	public function thing(){
		
		return $this->belongsTo('App\Models\Thing');

	}
	
	public function user(){
		
		return $this->belongsTo('App\User');

	}
	
}
