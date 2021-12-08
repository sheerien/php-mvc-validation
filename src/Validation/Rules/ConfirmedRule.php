<?php 
namespace Afkar\Test\Validation\Rules;

use Afkar\Test\Validation\Rules\contract\Rule;

class ConfirmedRule implements Rule
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
        return ($data[$field] === $data[$field . '_confirmation']);
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function __toString() 
    {
        return "%s dos't match %s confirmation";
	}
}