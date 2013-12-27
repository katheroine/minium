<?php

class Photo extends Eloquent {
	
	public function category()
	{
		return $this->belongsTo('PhotoCategory', 'photo_category_id');
	}
}