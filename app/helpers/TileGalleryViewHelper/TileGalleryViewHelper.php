<?php

/**
 * Class rebuilding photos collection and replenishing with additional gap images
 * placed in appropriate collection cells accordingly to gallery columns number.
 */
class TileGalleryViewHelper {
	
	/**
	 * Default number of columns.
	 */
	const COLUMNS_DEFAULT = 4;
	
	/**
	 * Patht to the gap image file.
	 */
	const GAP_IMAGE_FILE_PATH = 'assets/img/tile.png';
	
	/**
	 * Photos of the gallery.
	 *
	 * @var Illuminate\Database\Eloquent\Collection
	 */
	private $photos_collection;
	
	/**
	 * Columns of the gallery.
	 *
	 * @var int
	 */
	private $columns_number;
	
	/**
	 * Itemboard for images board.
	 *
	 * @var Itemboard
	 */
	private $itemboard;
	
	/**
	 * Replenish photos collection with additional gap images and returns replenished photos collection.
	 * 
	 * @param Illuminate\Database\Eloquent\Collection $photos_collection
	 * @param int $columns_number
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public static function replenishPhotosCollection($photos_collection, $columns_number = self::COLUMNS_DEFAULT)
	{
		$helper = new self($photos_collection, $columns_number);
		
		return $helper->photos_collection;
	}
	
	/**
	 * Constructor.
	 * 
	 * @param Illuminate\Database\Eloquent\Collection $photos_collection
	 * @param int $columns_number
	 */
	private function __construct($photos_collection, $columns_number)
	{
		$this->setPhotosCollection($photos_collection);
		$this->setColumnsNumber($columns_number);
		$this->setUpItemboard();
		$this->replenishImagesCollectionWithGaps();
	}
	
	/**
	 * Set photos_collection parameter.
	 * 
	 * @param Illuminate\Database\Eloquent\Collection $photos_collection
	 * @throws InvalidPropertyValueException
	 */
	private function setPhotosCollection($photos_collection)
	{
		$photos_collection_is_valid = self::valueIsValidForPhotosCollection($photos_collection);
		
		if ($photos_collection_is_valid)
		{
			$this->photos_collection = $photos_collection;
		}
		else
		{
			$exception_message = 'Invalid photos_collection property value. It must be integer greater than zero.';
			$exception = new InvalidPropertyValueException( $exception_message );

			throw $exception;
		}
	}
	
	/**
	 * Set columns_number property.
	 * 
	 * @param int $columns_number
	 * @throws InvalidPropertyValueException
	 */
	private function setColumnsNumber($columns_number)
	{
		$columns_number_is_valid = self::valueIsValidForColumnsNumber($columns_number);
		
		if ($columns_number_is_valid)
		{
			$this->columns_number = $columns_number;
		}
		else
		{
			$exception_message = 'Invalid columns_number property value. It must be integer greater than zero.';
			$exception = new InvalidPropertyValueException( $exception_message );

			throw $exception;
		}
	}
	
	/**
	 * Set up itemboard property.
	 */
	private function setUpItemboard()
	{
		$items_number = $this->photos_collection->count();
		$columns_number = $this->columns_number;
		
		$this->itemboard = new Itemboard($items_number, $columns_number);
		$this->itemboard->process();
	}
	
	/**
	 * Replenish photos collection with additional gap images
	 */
	private function replenishImagesCollectionWithGaps()
	{		
		$gaps_indexes = $this->itemboard->gapsIndexes();
		$photos_collection = $this->photos_collection;
		$photos_gallery = new Illuminate\Database\Eloquent\Collection;
		
		$photos_collection_count = $photos_collection->count() + count($this->itemboard->gapsIndexes());
		
		for($i = 0; $i < $photos_collection_count; $i++)
		{
			if (in_array($i, $gaps_indexes))
			{
				$photo = new Photo();
				$photo->file_path = self::GAP_IMAGE_FILE_PATH;
			}
			else
			{
				$photo = $photos_collection->pop();
			}

			$photos_gallery->push($photo);
		}
		
		$this->photos_collection = $photos_gallery;
	}
	
	/**
	 * Validate value for photos_collection property.
	 * 
	 * @param mixed $value
	 * @return boolean
	 */
	private static function valueIsValidForPhotosCollection($value)
	{
		$value_is_valid = (get_class($value) == 'Illuminate\Database\Eloquent\Collection');
		
		return $value_is_valid;
	}
	
	/**
	 * Validate value for columns_number property.
	 * 
	 * @param mixed $value
	 * @return boolean
	 */
	private static function valueIsValidForColumnsNumber($value)
	{
		$value_is_integer = is_integer($value);
		$value_is_greater_than_zero = ($value > 0);
		
		$value_is_valid = $value_is_integer && $value_is_greater_than_zero;
		
		return $value_is_valid;
	}
}