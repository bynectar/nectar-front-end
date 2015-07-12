<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, Auth, View;
use App\Models\Flag;
use App\Models\Review;
use App\Models\Thing;
use App\Models\Comment;

class FlagController extends Controller {

	/*
	* Require authenticated user
	*/
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	    // Create flag
	    $review_id = Input::get('review_id');
	    $thing_id = Input::get('thing_id');
	    $comment_id = Input::get('comment_id');
	    $flag = new Flag([
            'review_id' => Input::get('review_id'),
            'thing_id' => Input::get('thing_id'),
            'comment_id' => Input::get('comment_id'),
            'user_id'  => Auth::user()->id
	    ]);
	    $flag=Flag::create($flag->toArray());
	    
	    // Increment flag counter
	    if ( $review_id != null ){
		    $review = Review::find($review_id);
		    $review->flags_count = $review->flags()->count();
		    $review->update();
	    } elseif ( $thing_id != null ) {
		    $thing = Thing::find($thing_id);
		    $thing->flags_count = $thing->flags()->count();
		    $thing->update();
	    } elseif ( $comment_id != null ) {
		    $comment = Comment::find($comment_id);
		    $comment->flags_count = $comment->flags()->count();
		    $comment->update();
	    }
	    
	    // Back to the last page
	    return Redirect::back()->with('message','Operation Successful !');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
