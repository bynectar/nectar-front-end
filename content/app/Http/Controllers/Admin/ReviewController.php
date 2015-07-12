<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, Auth, View;
use App\Models\Review;
use App\Models\Rating;
use App\Models\Thing;
use App\Models\Flag;
use App\Models\Comment;
use App\User;

class ReviewController extends Controller {

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
		// Get Reviews, eager load associated models
		$reviews;
		$sort_by = Input::get('sort_by');
		$sort_order = Input::get('sort_order');
		$with_trashed = Input::get('with_trashed');
		
		if ( $with_trashed != true ){
			$reviews = Review::with(array('user','flags','votes','comments'))->get();
		} else {
			$reviews = Review::withTrashed()->with(array('user','flags','votes','comments'))->get();
		}
		
		// Check for sort_by and sort if requested
		if ( $sort_order === null || $sort_order === 'DESC' ){
				
			if ( $sort_by != null ){
				$reviews = $reviews->sortByDesc( $sort_by );
			};
		
		} else {
				
			if ( $sort_by != null ){
				$reviews = $reviews->sortBy( $sort_by );
			};
		
		}
		
		// Return the index view
		return view('admin.reviews.index', array('reviews' => $reviews));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$things = Thing::all()->toArray();
		$thingList = [];
		foreach($things as $thing){
			$thingList[$thing['id']] = $thing['title'];
		}
		return view('admin.reviews.create', array('things' => $thingList) );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	    // First Save a Review
	    $review = new Review([
	        'title'    => Input::get('title'),
	        'content'  => Input::get('content'),
            'thing_id' => Input::get('thing_id'),
            'user_id'  => Auth::user()->id
	    ]);
	    $newReview=Review::create($review->toArray());
		
		// Then save rating
	    $rating = [
	        'rating'    => Input::get('rating'),
            'user_id'  => Auth::user()->id
	    ];
		$review->find($newReview->id)->rating()->save(new Rating($rating));

	    return redirect('admin/reviews/' . $newReview->id)->withMessage('Review Saved Successfully !!!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$review = Review::with(array('user','thing','rating'))->get()->find($id);
		return view('admin.reviews.show', array('review' => $review));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$review = Review::find($id);
		$rating = $review->rating['rating'];
		return view('admin.reviews.edit', array('review' => $review, 'rating' => $rating));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title'		=> 'required',
            'content'	=> 'required',
            'rating'	=> 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('admin/reviews/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            // Update Review
            $review = Review::find($id);
            $review->title				= Input::get('title');
            $review->content			= Input::get('content');
            $review->thing_id			= Input::get('thing_id');
			$review->user_id			= Auth::user()->id;

            $review->push($review);
            
			// Then Update Rating
		    $rating = [
		        'rating'    => Input::get('rating'),
	            'user_id'  => Auth::user()->id
		    ];
			$review->find($id)->rating()->update($rating);

            // redirect
            Session::flash('message', 'Successfully updated review!');
            return Redirect::to('admin/reviews/' . $id);
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// Get user and delete
		$review = Review::find($id);
		$review->delete();
		
		return Redirect::back()->withMessage('Review Deleted Successfully !!!');
	}

}
