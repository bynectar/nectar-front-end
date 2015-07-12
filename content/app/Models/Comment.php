<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'comments';
    protected $dates = ['deleted_at'];
    protected $fillable = ['comment','review_id','user_id'];
    
	public function review(){
		
		return $this->belongsTo('App\Models\Review');

	}
	
	public function user(){
		
		return $this->belongsTo('App\User');

	}
	
}
