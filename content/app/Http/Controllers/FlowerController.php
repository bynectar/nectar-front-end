<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use Validator, Input, Redirect, Session, Auth, View, Storage, File;
use App\Models\Flower;
use App\Models\Image;
use App\User;

class FlowerController extends Controller {

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
	
		$flowers;
		$sort_by = Input::get('sort_by');
		$sort_order = Input::get('sort_order');
		
		$flowers = Flower::with('image')->get();

		// Check for sort_by and sort if requested
		if ( $sort_order === null || $sort_order === 'DESC' ){
				
			if ( $sort_by != null ){
				$flowers = $flowers->sortByDesc( $sort_by );
			};
		
		} else {
				
			if ( $sort_by != null ){
				$flowers = $flowers->sortBy( $sort_by );
			};
		
		}
	
		return view('flowers.index', array('flowers' => $flowers));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('flowers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
    // First Save a Flower
    $flower = new Flower([
        'common_name_1'   => Input::get('common_name_1'),
        'common_name_2'   => Input::get('common_name_2'),
        'common_name_3'   => Input::get('common_name_3'),
        'latin_name'      => Input::get('latin_name'),
        'content'         => Input::get('description'),
        'branches'        => Input::get('branches'),
        'berries'         => Input::get('berries'),
        'foliage'         => Input::get('foliage'),
        'spring'          => Input::get('spring'),
        'summer'          => Input::get('summer'),
        'fall'            => Input::get('fall'),
        'winter'          => Input::get('winter'),
        'user_id'         => Auth::user()->id
    ]);
    $newFlower=Flower::create($flower->toArray());
	
		// Then Update Image
		$image_file = Input::file('image_file');
		$extension = $image_file->getClientOriginalExtension();
		Storage::disk('local')->put($image_file->getFilename().'.'.$extension,  File::get($image_file));
		$image = new Image();
		$image->mime = $file->getClientMimeType();
		$image->filename = $file->getFilename().'.'.$extension;
		$image->title = Input::get('image_title');
		$image->description = Input::get('image_desc');

		$flower->find($newFlower->id)->image()->save(new Image($image));

    return redirect('flowers/' . $newFlower->id)->withMessage('Flower Saved Successfully !!!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$flower = Flower::with(array('image'))->get()->find($id);
		return view('flowers.show', array('flower' => $flower));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
    $flower = Flower::with(array('image'))->get()->find($id);
		return view('flowers.edit', array('flower' => $flower));
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
        'common_name_1'		=> 'required',
    );
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
      return Redirect::to('flowers/' . $id . '/edit')
        ->withErrors($validator)
        ->withInput(Input::except('password'));
    } else {
      // Update Flower
      $flower = Flower::find($id);
      $flower->common_name_1  = Input::get('common_name_1');
      $flower->common_name_2	= Input::get('common_name_2');
      $flower->common_name_3  = Input::get('common_name_3');
      $flower->latin_name     = Input::get('latin_name');
      $flower->branches       = Input::get('branches');
      $flower->berries        = Input::get('berries');
      $flower->foliage        = Input::get('foliage');
      $flower->spring         = Input::get('spring');
      $flower->summer         = Input::get('summer');
      $flower->fall           = Input::get('fall');
      $flower->winter         = Input::get('winter');
			$flower->user_id        = Auth::user()->id;

      $flower->push($flower);
      
			// Then Update Image
			$image_file = Request::file('image_file');
			$extension = $image_file->getClientOriginalExtension();
			Storage::disk('local')->put($image_file->getFilename().'.'.$extension,  File::get($image_file));
			$image = new Image();
  		$image->mime = $image_file->getClientMimeType();
  		$image->path = $image_file->getFilename().'.'.$extension;
  		$image->title = Input::get('image_title');
  		$image->description = Input::get('image_desc');
  		$image->flower_id = $flower->id;
   
			$image->save();
					
      // redirect
      Session::flash('message', 'Successfully updated flower!');
      return Redirect::to('flowers/' . $id . '/edit');
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
		$flower = Flower::find($id);
		$flower->delete();
		
		return redirect('flowers')->withMessage('Flower Deleted Successfully !!!');
	}

}
