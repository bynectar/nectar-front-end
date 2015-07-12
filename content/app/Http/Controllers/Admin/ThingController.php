<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, Auth, View;
use App\Models\Thing;
use App\Models\Category;
use App\Models\Review;
use App\User;

class ThingController extends Controller {

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
		$things = Thing::with(array('user','category'))->get();
		return view('things.index', array('things' => $things));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = Category::all()->toArray();
		$categoryList = [];
		foreach($categories as $category){
			$categoryList[$category['id']] = $category['title'];
		}
		return view('things.create',array('categories' => $categoryList));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	    $thing = new Thing([
	        'title'			=> Input::get('title'),
	        'description'	=> Input::get('description'),
            'category_id'	=> Input::get('category_id'),
            'user_id'		=> Auth::user()->id
	    ]);
	    
	    $newThing = Thing::create( $thing->toArray() );

	    return redirect('things')->withMessage('New Thing Saved Successfully !!!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$thing = Thing::with(['reviews'])->get()->find($id);
		return view('things.show', array('thing' => $thing));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$thing = Thing::find($id)->toArray();
		return view('things.edit', array('thing' => $thing));
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
            'title'			=> 'required',
            'description'	=> 'required',
            'category_id'	=> 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('things/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $thing = Review::find($id);
            $thing->title		= Input::get('title');
            $thing->description	= Input::get('description');
            $thing->category_id	= Input::get('category_id');
			$thing->user_id		= Auth::user()->id;

            $thing->push($thing);
            
            // redirect
            Session::flash('message', 'Successfully updated Thing!');
            return Redirect::to('things/' . $id);
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
		$thing = Thing::find($id);
		$thing->delete();
		
		return redirect('things')->withMessage('Thing Deleted Successfully !!!');
	}

}
