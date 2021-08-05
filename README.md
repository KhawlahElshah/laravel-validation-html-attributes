## Introduction

This package comes up with an easy, smart way to pass laravel validation rules to html form and use it as client side validation. 

----------

## Installation 
This Package can be installed via Composer 

```bash
composer require kalshah/laravel-validation-html-attributes
```

## How it works

The core work is done in a trait `WithHtmlAttributes` which can be used in two ways:


1- First by using the package request `LaravelValidationToHtmlAttributesRequest` which uses this trait, this suits you if you are validating request in controller methods

```php
    public function create(LaravelValidationToHtmlAttributesRequest $request)
    {
        $request->setRules([
            'first_name' => 'required'
        ]);
        
        return view('form', ['attributes' => $request->htmlAttributes()]);
    }
```


2- Second by using the `WithHtmlAttributes` in your **FormRequest**

```php
    use WithHtmlAttributes;
```

and in your controller you can pass the attributes like so:

```php
    public function create()
    {
        return view('form', ['attributes' => (new WithHtmlAttributesFormRequest())->htmlAttributes()]);
    }
```

and in the blade files you can access these attributes and add them on html form inputs, like so:

```html
<input name="first_name" {{ $attributes->first_name }}>
```

and lets assume the laravel validation rules of this field `first_name` were

```php
return ['first_name' => 'required|min:2|string'];
```

the returned html validation inputs will be

```html
<input name="first_name" required="required" minlength="2" type="string">
```

as we can see the trait converted laravel validation rules to valid html validation attributes.


