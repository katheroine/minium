<?php

class PhotoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// get all the photos
		$photos = Photo::all();
		
		// load the view and pass the photos
		return View::make('photos.index')->with('photos', $photos);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// load the view
		return View::make('photos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// validate
		$rules = array(
			'title' => 'required',
			'description' => 'required',
			'order' => 'numeric'
		);
		
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails())
		{
			return Redirect::to('photos/create')->withErrors($validator)->withInput(Input::all());
		}
		else
		{
			// store
			$photo = new Photo;
			
			$photo->title = Input::get('title');
			$photo->description = Input::get('description');
			$photo->order = Input::get('order');
			
			$photo->save();
			
			// redirect
			Session::flash('message', 'Succesfully uploaded photo!');
			return Redirect::to('photos');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// get the photo
		$photo = Photo::find($id);
		
		// load the view and pass the photo
		return View::make('photos.show')->with('photo', $photo);
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