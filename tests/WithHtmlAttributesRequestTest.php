<?php

namespace Kalshah\LaravelValidationHTMLAttirbutes\Tests;

use Kalshah\LaravelValidationHTMLAttirbutes\LaravelValidationToHtmlAttributesRequest;
use PHPUnit\Framework\TestCase;

class WithHtmlAttributesRequestTest extends TestCase
{
    function setup():void
    {
        $this->request = new LaravelValidationToHtmlAttributesRequest;
    }
    
    function test_it_returns_required_rule_as_required_html_attribute()
    {
        $this->request->setRules([
            'name' => 'required',
        ]);
        
        $this->assertEquals($this->request->htmlAttributes()->name, "required=required");
    }
    
    function test_it_returns_min_rule_as_minlength_html_attribute_if_field_is_string_or_email_or_url()
    {
        $this->request->setRules([
            'name' => 'string|min:3',
        ]);
        
        $this->assertStringContainsString("type=text minlength=3", $this->request->htmlAttributes()->name);
        
        $this->request->setRules([
            'email' => 'email|min:3',
        ]);
        
        $this->assertStringContainsString("type=email minlength=3", $this->request->htmlAttributes()->email);
        
        $this->request->setRules([
            'link' => 'url|min:3',
        ]);
        
        $this->assertStringContainsString("type=url minlength=3", $this->request->htmlAttributes()->link);
    }
    
    function test_it_returns_min_rule_as_minlength_html_attribute_if_field_is_number()
    {
        $this->request->setRules([
            'number' => 'numeric|min:3',
        ]);
        
        $this->assertStringContainsString("type=number min=3", $this->request->htmlAttributes()->number);
    }
    
    function test_it_returns_max_rule_as_maxlength_html_attribute_if_field_is_string_or_email_or_url()
    {
        $this->request->setRules([
            'name' => 'string|max:3',
        ]);
        
        $this->assertStringContainsString("type=text maxlength=3", $this->request->htmlAttributes()->name);
        
        $this->request->setRules([
            'email' => 'email|max:3',
        ]);
        
        $this->assertStringContainsString("type=email maxlength=3", $this->request->htmlAttributes()->email);
        
        $this->request->setRules([
            'link' => 'url|max:3',
        ]);
        
        $this->assertStringContainsString("type=url maxlength=3", $this->request->htmlAttributes()->link);
    }
    
    function test_it_returns_max_rule_as_maxlength_html_attribute_if_field_is_number()
    {
        $this->request->setRules([
            'number' => 'numeric|max:3',
        ]);
        
        $this->assertStringContainsString("type=number max=3", $this->request->htmlAttributes()->number);
    }
    
    function test_it_returns_string_rule_as_text_type_html_attribute()
    {
        $this->request->setRules([
            'name' => 'string',
        ]);
        
        $this->assertEquals($this->request->htmlAttributes()->name, "type=text");
    }
    
    function test_it_returns_date_rule_as_date_type_html_attribute()
    {
        $this->request->setRules([
            'birthday' => 'date',
        ]);
        
        $this->assertEquals($this->request->htmlAttributes()->birthday, "type=date");
    }
    
    function test_it_returns_numeric_rule_as_number_type_html_attribute()
    {
        $this->request->setRules([
            'number' => 'numeric',
        ]);
        
        $this->assertEquals($this->request->htmlAttributes()->number, "type=number");
    }
    
    function test_it_returns_email_rule_as_email_type_html_attribute()
    {
        $this->request->setRules([
            'email' => 'email',
        ]);
        
        $this->assertEquals($this->request->htmlAttributes()->email, "type=email");
    }
    
    function test_it_returns_url_rule_as_url_type_html_attribute()
    {
        $this->request->setRules([
            'link' => 'url',
        ]);
        
        $this->assertEquals($this->request->htmlAttributes()->link, "type=url");
    }

    function test_it_returns_array_rules_as_html_attribute()
    {
        $this->request->setRules([
            'name' => ['required', 'min:3'],
        ]);

        $this->assertEquals($this->request->htmlAttributes()->name, "required=required min=3");
    }
}
