# Examples

## Contact Form Example

**Page code:**
```ini
title = "Contact"
url = "/contact"
layout = "default"
[turnstileCaptcha]
==
function onFormSubmit()
{
    $data = post();
    $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required',
        'cf-turnstile-response' => 'required|turnstile',
    ];
    $validator = Validator::make($data, $rules);
    if ($validator->fails()) {
        throw new ValidationException($validator);
    }
    // Process form...
    return ['success' => 'Thank you!'];
}
==
```

**Form markup:**
```html
<form data-request="onFormSubmit" data-request-flash>
    {% component "turnstileCaptcha" %}
    <input name="name" required>
    <input name="email" type="email" required>
    <textarea name="message" required></textarea>
    <button type="submit">Send</button>
</form>
```

## Manual Verification Example

```php
use Depcore\Turnstile\Components\TurnstileCaptcha;

if (!TurnstileCaptcha::checkLegit()) {
    throw new ValidationException(['captcha' => 'CAPTCHA validation failed.']);
}
```

## Custom Theme Integration

You can style the widget container `.cf-turnstile` as needed in your theme CSS.
