<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Redirect, Session, Auth, View;
use App\Models\Category;
use App\User;

class CategoryController extends Controller {

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
		$categories = Category::with('user')->get();
		return view('categories.index', array('categories' => $categories));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('categories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	    $category = new Category([
	        'title'			=> Input::get('title'),
	        'description'	=> Input::get('description'),
            'user_id'		=> Auth::user()->id
	    ]);
	    
	    $newCategory = Category::create( $category->toArray() );

	    return redirect('categories')->withMessage('Category Saved Successfully !!!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$category = Category::find($id);
		return view('categories.show', array('category' => $category));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$category = Category::find($id)->toArray();
		return view('categories.edit', array('category' => $category));
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
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('categories/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $category = Review::find($id);
            $category->title		= Input::get('title');
            $category->description	= Input::get('description');
			$category->user_id		= Auth::user()->id;

            $category->push($category);
            
            // redirect
            Session::flash('message', 'Successfully updated category!');
            return Redirect::to('categories/' . $id);
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
		$category = Category::find($id);
		$category->delete();
		
		return redirect('categories')->withMessage('Category Deleted Successfully !!!');
	}

}
