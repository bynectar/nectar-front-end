<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, Auth, View;
use App\Models\Vote;
use App\Models\Review;

class VoteController extends Controller {

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
	    // Create vote
	    $review_id = Input::get('review_id');
	    $thing_id = Input::get('thing_id');
	    $category_id = Input::get('category_id');
	    $vote = new Vote([
            'review_id' => Input::get('review_id'),
            'thing_id' => Input::get('thing_id'),
            'category_id' => Input::get('category_id'),
            'user_id'  => Auth::user()->id
	    ]);
	    $vote=Vote::create($vote->toArray());
	    
	    // Increment vote counter
	    if ( $review_id != null ){
		    $review = Review::find($review_id);
		    $review->votes_count = $review->votes()->count();
		    $review->update();
	    } elseif ( $thing_id != null ) {
		    $thing = Thing::find($thing_id);
		    $thing->votes_count = $thing->votes()->count();
		    $thing->update();
	    } elseif ( $category_id != null ) {
		    $category = Category::find($category_id);
		    $category->votes_count = $category->votes()->count();
		    $category->update();
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
