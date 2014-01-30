<?php

/**
 * Class places set of items in table with given number of columns.
 * Free spaces are properly disposed in table so that they don't contact if it's possible.
 */
class Itemboard {
	
	/**
	 * States of gaps number and maximal blacks fields number in checkerboard ratio.
	 */
	const GAPS_NUM_EQUALS_MAX_BLACKS_NUM = 0;
	const GAPS_NUM_LESS_THAN_MAX_BLACKS_NUM = -1;
	const GAPS_NUM_GREATER_THAN_MAX_BLACKS_NUM = 1;
	
	/**
	 * Table with indexes of the gap fields.
	 *
	 * @var array
	 */
	private $gaps_indexes = array();
	
	/**
	 * Number of items.
	 *
	 * @var int
	 */
	private $items_number;
	
	/**
	 * Number of the board columns.
	 *
	 * @var int
	 */
	private $columns_number;
	
	/**
	 * Number of the board gap fields.
	 *
	 * @var int
	 */
	private $gaps_number;
	
	/**
	 * Checkerboard with appropriate dimensions.
	 *
	 * @var Checkerboard
	 */
	private $checkerboard;
	
	/**
	 * Gaps number and maximal blacks fields number in checkerboard ratio.
	 *
	 * @var boolean
	 */
	private $gaps_and_max_blacks_numbers_ratio;

	/**
	 * Constructor.
	 * 
	 * @param int $items_number
	 * @param int $columns
	 */
	public function __construct($items_number, $columns_number)
	{
		$this->setItemsNumber($items_number);
		$this->setColumnsNumber($columns_number);
		$this->setUpGapsNumber();
		$this->initializeCheckerboard();
		$this->setUPGapsAndMaxBlacksNumbersRatio();
		$this->processCheckerboard();
	}
	
	/**
	 * Set items_number property.
	 * 
	 * @param int $items_number
	 * @throws InvalidPropertyValueException
	 */
	private function setItemsNumber($items_number)
	{
		$items_number_is_valid = self::valueIsValidForItemsNumber($items_number);
		
		if ($items_number_is_valid)
		{
			$this->items_number = $items_number;
		}
		else
		{
			$exception_message = 'Invalid items_number property value. It must be integer greater than zero.';
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
	 * Set us gaps_number property.
	 */
	private function setUpGapsNumber()
	{
		$is_no_gaps_needed = ($this->items_number % $this->columns_number !== 0);
		
		$this->gaps_number = ($is_no_gaps_needed) ? $this->columns_number - ($this->items_number % $this->columns_number) : 0;
	}
	
	/**
	 * Set up gaps_and_max_blacks_numbers_ratio property.
	 */
	private function setUPGapsAndMaxBlacksNumbersRatio()
	{
		$maximal_blacks_number = $this->checkerboard->maximalBlacksNumber();
		
		$margin = $maximal_blacks_number - $this->gaps_number;
		
		if ($margin < 0)
		{
			$this->gaps_and_max_blacks_numbers_ratio = self::GAPS_NUM_GREATER_THAN_MAX_BLACKS_NUM;
		}
		elseif ($margin > 0)
		{
			$this->gaps_and_max_blacks_numbers_ratio = self::GAPS_NUM_LESS_THAN_MAX_BLACKS_NUM;
		}
		else
		{
			$this->gaps_and_max_blacks_numbers_ratio = self::GAPS_NUM_EQUALS_MAX_BLACKS_NUM;
		}
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
	
	/**
	 * Validate value for items_number property.
	 * 
	 * @param mixed $value
	 * @return boolean
	 */
	private static function valueIsValidForItemsNumber($value)
	{
		$value_is_integer = is_integer($value);
		$value_is_greather_than_zero = ($value > 0);
		
		$value_is_valid = $value_is_integer && $value_is_greather_than_zero;
		
		return $value_is_valid;
	}
	
	/**
	 * Initialize checkerboard property.
	 */
	private function initializeCheckerboard()
	{
		$columns_number = $this->columns_number;
		$rows_number = (int) ceil($this->items_number / $columns_number);
				
		$this->checkerboard = new Checkerboard($columns_number, $rows_number);
	}
	
	/**
	 * Process checkerboard.
	 * Find balck and white fields indexes.
	 */
	private function processCheckerboard()
	{
		if ($this->gaps_and_max_blacks_numbers_ratio === self::GAPS_NUM_LESS_THAN_MAX_BLACKS_NUM)
		{
			$this->checkerboard->process();
		}
		else
		{
			$this->checkerboard->process(0);
		}
	}
	
	/**
	 * Fill gaps_indexes property with proper indexes.
	 */
	public function process()
	{
		switch ($this->gaps_and_max_blacks_numbers_ratio)
		{
			case static::GAPS_NUM_LESS_THAN_MAX_BLACKS_NUM :
				$this->drawGapsFromBlacks();
				break;
			case static::GAPS_NUM_GREATER_THAN_MAX_BLACKS_NUM :
				$this->replenishGapsFromWhites();
			case static::GAPS_NUM_EQUALS_MAX_BLACKS_NUM :
				$this->rewriteGapsFromBlacks();
				break;
		}
	}
	
	/**
	 * Draw gaps indexes from black fields.
	 */
	private function drawGapsFromBlacks()
	{
		$gaps_number = $this->gaps_number;
		$blacks_indexes = $this->checkerboard->blacksIndexes();
		
		while ($gaps_number-- > 0)
		{
			$black_index = static::drawAndRemoveFromArray($blacks_indexes);
			array_push($this->gaps_indexes, $black_index);
		}
	}
	
	/**
	 * Rewrite indexes from all the black fields to gaps.
	 */
	private function rewriteGapsFromBlacks()
	{
		$this->gaps_indexes = array_merge($this->gaps_indexes, $this->checkerboard->blacksIndexes());
	}
	
	/**
	 * Replenish gaps_indexes array with indexes of white fields.
	 */
	private function replenishGapsFromWhites()
	{
		$maximal_blacks_number = $this->checkerboard->maximalBlacksNumber();
		$vacancies_number = $this->gaps_number - $maximal_blacks_number;
		$whites_indexes = $this->checkerboard->whitesIndexes();
		
		while ($vacancies_number-- > 0)
		{
			$white_index = static::drawAndRemoveFromArray($whites_indexes);
			array_push($this->gaps_indexes, $white_index);
		}
	}
	
	/**
	 * Draw one item from array, delete it and return it's value.
	 * 
	 * @param array $array
	 */
	private static function drawAndRemoveFromArray(&$array)
	{
		$index = array_rand($array);
		$value = $array[$index];
		unset($array[$index]);
		
		return $value;
	}
	
	/**
	 * Return gaps indexes.
	 * 
	 * @return array
	 */
	public function gapsIndexes()
	{
		return $this->gaps_indexes;
	}
}