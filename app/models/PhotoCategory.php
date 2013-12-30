<?php

class PhotoCategory extends Eloquent {
	
	public function photos()
	{
		return $this->hasMany('Photo');
	}
	
	/**
	 * Returns array with model item IDs as keys and names as values.
	 * 
	 * @return array
	 */
	static public function allNames()
	{	
		$categories = PhotoCategory::all();
		
		$names = array();
		
		$categories->map(function($value) use (&$names)
		{
			$id = $value['id'];
			$names[$id] = $value['name'];
		});
		
		return $names;
	}
}