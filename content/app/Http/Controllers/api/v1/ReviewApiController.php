<?php namespace App\Http\Controllers\api\v1;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, Auth, View;
use App\Models\Review;
use App\Models\Rating;
use App\Models\Thing;
use App\User;

class ReviewApiController extends Controller {

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
		$reviews = Review::with('user')->get();
		return view('reviews.index', array('reviews' => $reviews));
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
		return view('reviews.create', array('things' => $thingList) );
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

	    return redirect('reviews/' . $newReview->id)->withMessage('Review Saved Successfully !!!');
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
		$review = Review::find($id);
		$rating = $review->rating['rating'];
		return view('reviews.edit', array('review' => $review, 'rating' => $rating));
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
            return Redirect::to('reviews/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
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

}
