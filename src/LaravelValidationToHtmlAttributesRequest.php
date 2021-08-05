<?php

namespace Kalshah\LaravelValidationHTMLAttirbutes;

use Illuminate\Http\Request;

class LaravelValidationToHtmlAttributesRequest extends Request
{
    use WithHtmlAttributes;
        
    protected $rules;
    
    /**
     * Get the validation rules that convert to html attributes.
     *
     * @return array
     */
    public function rules()
    {
        return $this->rules?: [];
    }
    
    public function setRules($rules)
    {
        $this->rules = $rules;
    }
}
