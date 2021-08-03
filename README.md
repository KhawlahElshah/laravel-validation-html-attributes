## Introduction

This package comes up with an easy, smart way to pass laravel validation rules to html form and use it as client side validation. 

## How it works

The core work is done in a trait `WithHtmlAttributes` which can be added to laravel **FormRequests** 

```php
    use WithHtmlAttributes;
```

this trait is responsible of converting the laravel validation rules to the blade files from anywhere in the project, for example:

```php
 return view('form', ['attributes' => (new CustomFormRequest)->htmlAttributes()]);
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


