<?php
namespace Afkar\Test\Validation;

use Afkar\Test\Validation\core\Message;
use Afkar\Test\Validation\core\ErrorBag;
use Afkar\Test\Validation\core\RuleMapHandler;
use Afkar\Test\Validation\core\RuleResolver;

class Validator
{
    protected array $data = [];

    protected array $aliases = [];

    protected array $rules = [];

    protected ErrorBag $errorBag;

    public function make($data)
    {
        $this->data = $data;
        $this->errorBag = new ErrorBag();
        $this->validate();
    }

    protected function validate()
    {
        foreach ($this->rules as $field => $rules) {
            foreach (RuleResolver::make($rules) as $rule) {
                $this->applyRule($field, $rule);
            }
        }
    }

    public function getFieldValue($field)
    {
        return $this->data[$field] ?? null;
    }

    public function setRules($rules)
    {
        $this->rules = $rules;
    }

    public function passes()
    {
        return empty($this->errors());
    }

    public function errors($key = null)
    {
        return $key ? $this->errorBag->errors[$key] : $this->errorBag->errors;
    }

    public function alias($field)
    {
        return $this->aliases[$field] ?? $field;
    }

    public function setAliases(array $aliases)
    {
        return $this->aliases = $aliases;
    }

    public function applyRule($field, $rule)
    {
            if(! $rule->apply($field, $this->getFieldValue($field), $this->data)){
            $this->errorBag->add($field, Message::generate($rule, $this->alias($field)));
        }
    }
}