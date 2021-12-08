<?php
namespace Afkar\Test\Validation\Rules;

use Afkar\Test\Validation\Rules\contract\Rule;

class RequiredRule implements Rule
{
    
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
        return !empty($value);
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function __toString() 
    {
        return "%s is required can't be empty";
	}
}