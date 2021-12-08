<?php 
namespace Afkar\Test\Validation\Rules\contract;

interface Rule
{
    public function apply($field, $value, $data);

    public function __toString();
}