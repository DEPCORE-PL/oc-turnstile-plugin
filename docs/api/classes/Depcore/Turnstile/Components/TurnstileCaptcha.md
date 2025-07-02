***

# TurnstileCaptcha

TurnstileCaptcha component class.

This component integrates the Cloudflare Turnstile CAPTCHA into your application,
providing bot protection for forms and other user interactions.

* Full name: `\Depcore\Turnstile\Components\TurnstileCaptcha`
* Parent class: [`ComponentBase`](../../../Cms/Classes/ComponentBase.md)

**See Also:**

* https://docs.octobercms.com/3.x/extend/cms-components.html - 




## Methods


### isCaptchaLegit

Validates the legitimacy of a Turnstile CAPTCHA response.

```php
public static isCaptchaLegit(string $turnstileResponse): bool
```

This static method checks whether the provided Turnstile CAPTCHA response token
is valid and has been successfully verified. It is typically used to prevent
automated submissions and ensure that the request is made by a human user.

* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$turnstileResponse` | **string** | The response token received from the Turnstile CAPTCHA widget. |


**Return Value:**

Returns true if the CAPTCHA response is valid; otherwise, false.




***

### checkLegit

Checks if the current request is legitimate.

```php
public static checkLegit(): bool
```

This static method performs validation to determine whether the request
passes the necessary legitimacy checks, such as verifying CAPTCHA responses
or other anti-bot mechanisms.

* This method is **static**.





**Return Value:**

Returns true if the request is legitimate, false otherwise.




***

### onRender

Handles the rendering of the Turnstile CAPTCHA component.

```php
public onRender(): void
```

This method is typically called to generate and display the CAPTCHA widget
on the frontend. It prepares any necessary data and returns the rendered output.










***

### componentDetails



```php
public componentDetails(): mixed
```












***

### onRun

Applies the necessary scripts to make turnstile work

```php
public onRun(): void
```

This method loads the turnstile script with an additional fix for reloading after failed validation










***


***
> Automatically generated on 2025-07-02
