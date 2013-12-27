<?php

class PhotoCategoryController extends \BaseController {
	
	/**
	 * The layout that should be used for responses.
	 */
	
	protected $layout = 'layouts.main';
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// get all the photo categories
		$photo_categories = PhotoCategory::all();
		
		// load the view and pass the photo categories
		return View::make('photo_categories.index')->with('photo_categories', $photo_categories);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// load the view
		return View::make('photo_categories.create');
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
			'name' => 'required',
			'description' => 'required'
		);
		
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails())
		{
			return Redirect::to('photo_categories/create')->withErrors($validator)->withInput(Input::all());
		}
		else
		{
			// store
			$this->saveStoredPhotoCategory();
			
			// redirect
			return Redirect::to('photo_categories');
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
		// get the photo category
		$photo_category = PhotoCategory::find($id);
		
		// load the view and pass the photo category
		return View::make('photo_categories.show')->with('photo_category', $photo_category);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the photo category
		$photo_category = PhotoCategory::find($id);
		
		// load the view and pass the photo category
		return View::make('photo_categories.edit')->with('photo_category', $photo_category);
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
		$rules = array(
			'name' => 'required',
			'description' => 'required'
		);
		
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails())
		{
			return Redirect::to('photo_categories/' . $id . '/edit')->withErrors($validator)->withInput(Input::all());
		}
		else
		{
			// store
			$this->saveUpdatedPhotoCategory($id);
			
			// redirect
			return Redirect::to('photo_categories');
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
		//
	}
	
	/**
	 * Save the newly stored photo category data in the database.
	 */
	private function saveStoredPhotoCategory()
	{
		$photo_category = new PhotoCategory;
			
		$photo_category->name = Input::get('name');
		$photo_category->description = Input::get('description');
		
		$photo_category->save();
			
		Session::flash('message', 'Succesfully created photo category!');
	}
	
	/**
	 * Save the specified updated photo category data in the database.
	 * 
	 * @param  int  $id
	 */
	private function saveUpdatedPhotoCategory($id)
	{
		$photo_category = PhotoCategory::find($id);
			
		$photo_category->name = Input::get('name');
		$photo_category->description = Input::get('description');
		
		$photo_category->save();

		Session::flash('message', 'Succesfully updated photo category!');
	}
}