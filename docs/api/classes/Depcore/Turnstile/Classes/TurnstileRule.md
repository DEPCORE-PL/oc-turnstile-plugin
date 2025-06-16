***

# TurnstileRule

Class TurnstileRule

Provides a validation rule for verifying Turnstile CAPTCHA responses.

This rule can be used in form validation to ensure that the submitted CAPTCHA
response is valid by delegating the verification to the TurnstileCaptcha component.

* Full name: `\Depcore\Turnstile\Classes\TurnstileRule`




## Methods


### validate

Determines if the validation rule passes.

```php
public validate(string $attribute, mixed $value, array $params): bool
```

This method checks if the provided CAPTCHA value is legitimate by calling
the TurnstileCaptcha::isCaptchaLegit method.






**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$attribute` | **string** | The name of the attribute under validation. |
| `$value` | **mixed** | The value of the attribute under validation (CAPTCHA response token). |
| `$params` | **array** | Additional parameters for the validation rule (unused). |


**Return Value:**

Returns true if the CAPTCHA is valid, false otherwise.




***

### message

Gets the validation error message.

```php
public message(): string
```

This message will be returned if the CAPTCHA validation fails.







**Return Value:**

The error message for invalid CAPTCHA.




***


***
> Automatically generated on 2025-06-16
