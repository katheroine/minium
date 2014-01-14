<?php

class HomeController extends BaseController {

	/**
	 * The layout that should be used for responses.
	 */
	
	protected $layout = 'layouts.home';
	
	/**
	 * Display the favourite photos and list of categories.
	 *
	 * @return Response
	 */
	public function index()
	{
		// get all the photos
		$favourite_photos = Photo::where('is_favourite', true)->get();
		
		// get all the photo categories
		$photo_categories = PhotoCategory::all();
		
		// load the view and pass the photos
		return View::make('home.index')->with('favourite_photos', $favourite_photos)->with('photo_categories', $photo_categories);
		
	}
	
	/**
	 * Display the specified photo.
	 * 
	 * @param int $id
	 * @return Response
	 */
	public function photo($id)
	{
		//
	}
	
	/**
	 * Display all the photos of specified category.
	 * 
	 * @param int $id
	 * @return Response
	 */
	public function photo_category($id)
	{
		//
	}
	
	/**
	 * Display data abuot the photographer.
	 * 
	 * @return Response
	 */
	public function about()
	{
		//
	}

}