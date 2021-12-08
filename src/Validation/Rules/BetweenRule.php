<?php
namespace Afkar\Test\Validation\Rules;

use Afkar\Test\Validation\Rules\contract\Rule;

class BetweenRule implements Rule
{
        /**
     * Max Number 
     * 
     * @var int $max
     */
    protected int $min;
    
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
    public function __construct(int $min, int $max)
    {
        $this->min = $min;
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
        if(strlen($value) < $this->min){
            return false;
        }
        if(strlen($value) > $this->max){
            return false;
        }

        return true;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function __toString() 
    {
        return "%s must be between ({$this->min}) and ({$this->max}) characters";
	}
}