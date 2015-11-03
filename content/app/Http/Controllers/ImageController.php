<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, Auth, View;
use App\Models\Image;
use App\Models\Flower;
use App\User;

class ImageController extends Controller {

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
	
		$images;
		$sort_by = Input::get('sort_by');
		$sort_order = Input::get('sort_order');
		
		$images = Image::with('flower')->get();

		// Check for sort_by and sort if requested
		if ( $sort_order === null || $sort_order === 'DESC' ){
				
			if ( $sort_by != null ){
				$images = $images->sortByDesc( $sort_by );
			};
		
		} else {
				
			if ( $sort_by != null ){
				$images = $images->sortBy( $sort_by );
			};
		
		}
	
		return view('images.index', array('images' => $images));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('images.create', array() );
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
		$image = Image::with(array('flower'))->get()->find($id);
		return view('images.show', array('image' => $image));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$image = Image::find($id);
		$flower = $image->flower();
		return view('images.edit', array('image' => $image, 'flower' => $flower));
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
		
		return redirect('admin/reviews')->withMessage('Review Deleted Successfully !!!');
	}

}
