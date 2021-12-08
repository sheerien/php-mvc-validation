<?php
namespace Afkar\Test\Validation\Rules;

use Afkar\Test\Validation\Rules\contract\Rule;

class EmailRule implements Rule
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
        return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $value);
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function __toString() 
    {
        return 'your %s address is not a valid email address';
	}
}