<?php
namespace Afkar\Test\Validation\Rules;

use Afkar\Test\Validation\Rules\contract\Rule;

class MaxRule implements Rule
{
    /**
     * Max Number 
     * 
     * @var int $max
     */
    protected int $max;
    
    /**
     * MaxRule Constructor
     * 
     * @param int $max
     */
    public function __construct(int $max)
    {
        $this->max = $max;
    }
    
	/**
	 *
	 * @param mixed $field 
	 * @param mixed $value 
	 * @param mixed $data 
	 *
	 * @return mixed
	 */
	public function apply($field, $value, $data) 
    {
        return strlen($value) <= $this->max;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function __toString() 
    {
        return "%s must be less than or equal to ({$this->max}) characters";
	}
}