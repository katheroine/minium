<?php

/**
 * Class modeling checkerboard.
 * Table with boolean values in the cells, alternately true and false.
 */
class Checkerboard {
	
	/**
	 * Table with indexes of the fields with false value.
	 *
	 * @var array
	 */
	private $blacks_indexes = array();
	
	/**
	 * Table with indexes of the fields with false value.
	 *
	 * @var array
	 */
	private $whites_indexes = array();
	
	/**
	 * Number of the checkerboard columns.
	 *
	 * @var int
	 */
	private $columns_number;
	
	/**
	 * Number of the checkerboard rows.
	 *
	 * @var int
	 */
	private $rows_number;
	
	/**
	 * Number of the checkerboard fields.
	 *
	 * @var int
	 */
	private $places_number;
	
	/**
	 * Number of the checkerboard fields with false value.
	 *
	 * @var int
	 */
	private $blacks_number = 0;
	
	/**
	 * Number of the checkerboard fields with true value.
	 *
	 * @var int
	 */
	private $whites_number = 0;
	
	/**
	 * Index of first field with false value.
	 *
	 * @var int
	 */
	private $start_black_index;
	
	/**
	 * Constructor.
	 * 
	 * @param int $columns_number
	 * @param int $rows_number
	 */
	public function __construct($columns_number, $rows_number)
	{
		$this->setColumnsNumber($columns_number);
		$this->setRowsNumber($rows_number);
		$this->setUpPlacesNumber();
		$this->setUpBoard();
	}
	
	/**
	 * Set columns_number property.
	 * 
	 * @param int $columns_number
	 * @throws InvalidPropertyValueException
	 */
	private function setColumnsNumber($columns_number)
	{
		$columns_number_is_valid = self::valueIsValidForBoardDimension($columns_number);
		
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
	 * Set rows_number property.
	 * 
	 * @param int $rows_number
	 * @throws InvalidPropertyValueException
	 */
	private function setRowsNumber($rows_number)
	{
		$rows_number_is_valid = self::valueIsValidForBoardDimension($rows_number);
		
		if ($rows_number_is_valid)
		{
			$this->rows_number = $rows_number;
		}
		else
		{
			$exception_message = 'Invalid rows_number property value. It must be integer greater than zero.';
			$exception = new InvalidPropertyValueException( $exception_message );

			throw $exception;
		}
	}
	
	/**
	 * Set up places_number property.
	 */
	private function setUpPlacesNumber()
	{
		$this->places_number = $this->columns_number * $this->rows_number;
	}
	
	private function setUpBoard()
	{
		$this->board = array_fill(0, $this->places_number, true);
	}
	
	/**
	 * Validate value for board dimension (rows_number or columns_number).
	 * 
	 * @param mixed $value
	 * @return bool
	 */
	private static function valueIsValidForBoardDimension($value)
	{
		$value_is_integer = is_integer($value);
		$value_is_greater_than_zero = ($value > 0);
		
		$value_is_valid = $value_is_integer && $value_is_greater_than_zero;
		
		return $value_is_valid;
	}
	
	/**
	 * Indicate whether numbers of black and white fields are equal
	 * notwithstanding the index of first black field will be 0 or 1.
	 * 
	 * @return boolean
	 */
	public function equalBlacksAndWhitesNumbers()
	{
		$columns_number_is_uneven = ($this->columns_number % 2 === 1);
		$rows_number_is_uneven = ($this->rows_number % 2 === 1);
		
		$blacks_and_whites_numbers_are_equal = $columns_number_is_uneven && $rows_number_is_uneven;
		
		return $blacks_and_whites_numbers_are_equal;
	}
	
	/**
	 * Return maximal number of black fields.
	 * 
	 * @return int
	 */
	public function maximalBlacksNumber()
	{
		$maximal_blacks_number = ceil($this->places_number / 2);
		
		return $maximal_blacks_number;
	}
	
	/**
	 * Find all indexes of the black and white fields.
	 * 
	 * @param int $start
	 */
	public function process($start = null)
	{
		$this->setStart($start);
		$this->findBlacksIndexes();
		$this->findWhitesIndexes();
	}

	/**
	 * Set start property.
	 * 
	 * @param int|null $start
	 * @throws InvalidPropertyValueException
	 */
	private function setStart($start)
	{
		$start_is_valid = self::valueIsValidForStart($start);
		
		if ($start_is_valid)
		{
			$this->start = is_null($start) ? rand(0, 1) : $start;
		}
		else
		{
			$exception_message = 'Invalid start property value. It must be 0, 1 or null.';
			$exception = new InvalidPropertyValueException( $exception_message );

			throw $exception;
		}
	}
	
	/**
	 * Validate value for start property.
	 * 
	 * @param mixed $value
	 * @return boolean
	 */
	private static function valueIsValidForStart($value)
	{
		$value_is_null = is_null($value);
		$value_is_zero_or_one = ($value === 0) || ($value === 1);
		
		$value_is_valid = $value_is_null || $value_is_zero_or_one;
		
		return $value_is_valid;
	}
	
	/**
	 * Find all indexes of the black fields.
	 */
	private function findBlacksIndexes()
	{
		$index = $this->start;
		
		$even_columns = ($this->columns_number % 2 == 0);
		
		while ($index < $this->places_number)
		{
			array_push($this->blacks_indexes, $index);

			$prev_index_is_on_edge = (($index + 1) % $this->columns_number == 0);
			$prev_index_is_one_step_to_edge = (($index + 2) % $this->columns_number == 0);

			if ($even_columns && $prev_index_is_on_edge)
			{
				$index = $index + 1;
			}
			elseif ($even_columns && $prev_index_is_one_step_to_edge)
			{
				$index = $index + 3;
			}
			else
			{
				$index = $index + 2;
			}
		}
	}
	
	/**
	 * Find all indexes of the white fields.
	 */
	private function findWhitesIndexes()
	{
		$all_fields_indexes = range(0, $this->places_number - 1);
		
		$this->whites_indexes = array_diff($all_fields_indexes, $this->blacks_indexes);
	}
	
	/**
	 * Returns indexes of all black fields.
	 * 
	 * @return array
	 */
	public function blacksIndexes()
	{
		return $this->blacks_indexes;
	}
	
	/**
	 * Returns indexes of all white fields.
	 * 
	 * @return array
	 */
	public function whitesIndexes()
	{
		return $this->whites_indexes;
	}
}

