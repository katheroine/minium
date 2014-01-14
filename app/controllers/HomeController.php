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
		return View::make('hello');
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