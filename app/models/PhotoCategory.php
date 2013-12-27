<?php

class PhotoCategory extends Eloquent {
	
	public function photos()
	{
		return $this->hasMany('Photo');
	}
}