<?php namespace App\Http\Controllers\api\v1;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, Auth, View;
use App\Models\Rating;
use App\Models\Review;
use App\User;

class RatingApiController extends Controller {

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
		$ratings = Review::with('review','user')->get();
		return view('ratings.index', array('ratings' => $ratings));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    // First Create a draft Review
	    $review = new Review([
            'title' => Input::get('title'),
            'content' => Input::get('content'),
            'thing_id' => Input::get('thing_id'),
            'user_id'  => Auth::user()->id
	    ]);
	    $review = Review::create( $review->toArray() );

	    // First Create a draft Review
	    $rating = new Rating([
            'rating' => Input::get('rating'),
            'review_id' => Input::get('review_id'),
            'user_id'  => Auth::user()->id
	    ]);
	    $newRating = Rating::create( $rating->toArray() );

		return view('reviews.edit', array('id' => $rating->id) );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	    $review = new Review([
	        'title'    => Input::get('title'),
	        'content'  => Input::get('content'),
            'thing_id' => Input::get('thing_id'),
            'user_id'  => Auth::user()->id
	    ]);
	    $newReview=Review::create( $review->toArray() );

	    return redirect('reviews')->withMessage('Review Saved Successfully !!!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$review = Review::find($id);
		return view('reviews.show', array('review' => $review));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$review = Review::find($id)->toArray();
		return view('reviews.edit', array('review' => $review));
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
            'title'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('reviews/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $review = Review::find($id);
            $review->title          = Input::get('title');
            $review->content        = Input::get('content');
            $review->thing_id       = Input::get('thing_id');
			$review->user_id		= Auth::user()->id;

            $review->push($review);
            
            // redirect
            Session::flash('message', 'Successfully updated review!');
            return Redirect::to('reviews/' . $id);
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
		
		return redirect('reviews')->withMessage('Review Deleted Successfully !!!');
	}

	/**
	 * Store a draft Review and redirect to edit view.
	 */
	public function draft($thing_id)
	{
	    $newReview=Review::create( $review->toArray() );
        return Redirect::to('reviews/' . $newReview->id);
	}

}
