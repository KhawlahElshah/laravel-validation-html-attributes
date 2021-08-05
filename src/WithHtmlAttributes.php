<?php

namespace Kalshah\LaravelValidationHTMLAttirbutes;

trait WithHtmlAttributes
{
    /**
     * Array of laravel rules
     */
    protected $rules;
    
    public function htmlAttributes()
    {
        $attributes = array_map(function($fieldAttributes){
            return implode(' ', $fieldAttributes);
        }, $this->formatRules()->toArray());
        
        return (object) $attributes;
    }

    public function formatRules()
    {
        $htmlAttributes = collect($this->rules())->map(function ($field) {
            $this->rules = explode('|', $field);
            
            return array_map(function ($rule) {
                $ruleArray = explode(':', $rule);

                $ruleName = $ruleArray[0];
                $ruleValue = array_key_exists(1, $ruleArray) ? $ruleArray[1] : null;

                if (method_exists($this, $ruleName)) {
                    return $ruleValue? $this->$ruleName($ruleValue) : $this->$ruleName();
                }
            }, $this->rules);
        });

        return $htmlAttributes;
    }

    public function required()
    {
        $param = "required";

        return "required={$param}";
    }

    public function min($param)
    {
        if (array_intersect(['string', 'email', 'url'], $this->rules)) {
            return "minlength={$param}";
        }
        
        return "min={$param}";
    }
    
    public function max($param)
    {
        if (array_intersect(['string', 'email', 'url'], $this->rules)) {
            return "maxlength={$param}";
        }
        
        return "max={$param}";
    }
    
    public function date()
    {
        return "type=date";
    }
    
    public function string()
    {
        return "type=text";
    }
    
    public function numeric()
    {
        return "type=number";
    }
    
    public function email()
    {
        return "type=email";
    }
    
    // TODO:: Fix this
    // public function file()
    // {
    //     return "type=file";
    // }
    
    public function password()
    {
        return "type=password";
    }
    
    public function url()
    {
        return "type=url";
    }
}

