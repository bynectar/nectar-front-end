<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, EntrustUserTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];
	
	// Get Reviews for this User
	public function reviews(){
		
		return $this->hasMany('App\Models\Review');

	}

	// Get Categories for this User
	public function categories(){
		
		return $this->hasMany('App\Models\Category');

	}

	// Get Ratings for this User
	public function ratings(){
		
		return $this->hasMany('App\Models\Rating');

	}

	// Get Flags for this User
	public function flags(){
		
		return $this->hasMany('App\Models\Flag');

	}

	// Get Things for this User
	public function things(){
		
		return $this->hasMany('App\Models\Thing');

	}

}
