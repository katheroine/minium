<?php

class PhotoController extends \BaseController {
	
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
			'file' => 'required',
			'category' => 'required'
		);
		
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails())
		{
			return Redirect::to('admin/photos/create')->withErrors($validator)->withInput(Input::except('file'));
		}
		else
		{
			// store
			$this->saveStoredPhoto();
			
			// redirect
			return Redirect::to('admin/photos');
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
		// get the photo
		$photo = Photo::find($id);
		
		// load the view and pass the photo
		return View::make('photos.edit')->with('photo', $photo);
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
			'title' => 'required',
			'file_path' => 'required',
			'category' => 'required'
		);
		
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails())
		{
			return Redirect::to('admin/photos' . $id . '/edit')->withErrors($validator)->withInput(Input::all());
		}
		else
		{
			// store
			$this->saveUpdatedPhoto($id);
			
			// redirect
			return Redirect::to('admin/photos');
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
		// delete
		$photo = Photo::find($id);
		$photo->delete();
		
		$delete_success = File::delete($photo->file_path);
		
		if ($delete_success)
		{
			Session::flash('message', 'Successfully delete the photo!');
		}
		else
		{
			Session::flash('error', 'Photo file deleting error!');
		}
		
		// redirect
		return Redirect::to('admin/photos');
	}
	
	/**
	 * Save the newly stored photo file in the storage directory and save photo data in the database.
	 */
	private function saveStoredPhoto()
	{
		$file = Input::file('file');

		$destinationPath = $this->buildPhotoFileDestinationPath();
		$fileName = $file->getClientOriginalName();

		$upload_success = $file->move($destinationPath, $fileName);

		if ($upload_success)
		{
			$photo = new Photo;
			
			$photo->is_favourite = Input::get('is_favourite') ? true : false;
			$photo->title = Input::get('title');
			$photo->description = Input::get('description');
			$photo->file_path = $destinationPath . $fileName;
			$photo->photo_category_id = Input::get('category');
			
			$photo->save();
			
			Session::flash('message', 'Succesfully uploaded photo!');
		}
		else
		{
			Session::flash('error', 'Photo file uploading error!');
		}
	}
	
	/**
	 * Save the specified updated photo data in the database.
	 * 
	 * @param  int  $id
	 */
	private function saveUpdatedPhoto($id)
	{
		$photo = Photo::find($id);
			
		$photo->is_favourite = Input::get('is_favourite') ? true : false;
		$photo->title = Input::get('title');
		$photo->description = Input::get('description');
		$photo->file_path = Input::get('file_path');
		$photo->photo_category_id = Input::get('category');

		$photo->save();

		Session::flash('message', 'Succesfully updated photo!');
	}
	
	/**
	 * Bulids storage directory path
	 * 
	 * @return string
	 */
	private function buildPhotoFileDestinationPath()
	{
		return 'uploads/' . str_random(8) . '/';
	}
}