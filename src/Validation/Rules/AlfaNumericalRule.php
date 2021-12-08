<?php
namespace Afkar\Test\Validation\Rules;

use Afkar\Test\Validation\Rules\contract\Rule;

class AlfaNumericalRule implements Rule
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
        return preg_match('/^[a-zA-Z0-9]+/', $value);
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function __toString() 
    {
        return "%s must be characters and numbers only";
	}
}