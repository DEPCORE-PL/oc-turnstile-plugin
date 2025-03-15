# OctoberCMS Turnstile Captcha Plugin (Internal Use)

This plugin is designed for internal use within our organization. It integrates Cloudflare's Turnstile CAPTCHA into OctoberCMS projects, providing a simple and effective way to add CAPTCHA validation to forms. This ensures that form submissions are made by humans and not bots.

## Key Features

- **Turnstile CAPTCHA Integration**: Easily add Cloudflare's Turnstile CAPTCHA to any form.
- **Settings Page**: Manage your Turnstile site key and secret key directly from the OctoberCMS backend.
- **Component-Based**: Use the provided `turnstileCaptcha` component to add CAPTCHA to forms with minimal effort.
- **Validation**: Automatically validate CAPTCHA responses on form submission.
- **Custom Validation Rule**: A built-in validation rule (`turnstile`) simplifies CAPTCHA validation in form requests.
- **Manual Verification**: Use the `TurnstileCaptcha::checkLegit()` or `TurnstileCaptcha::isCaptchaLegit()` methods to manually verify CAPTCHA responses.

---

## How It Works

The plugin consists of three main parts:

1. **Settings Page**:
   A backend settings page where you can configure the Turnstile site key and secret key. These keys are stored using OctoberCMS's `SettingsModel`.

2. **Turnstile Component**:
   A reusable component (`turnstileCaptcha`) that can be added to any form. It handles the rendering of the CAPTCHA widget and validates the response on form submission.

3. **Custom Validation Rule**:
   A custom validation rule (`turnstile`) is registered to simplify CAPTCHA validation in form requests.

4. **Manual Verification Methods**:
   The plugin provides two methods for manually verifying CAPTCHA responses:
    - `TurnstileCaptcha::checkLegit()`: Returns a boolean (`true` if the CAPTCHA is verified, otherwise `false`).
    - `TurnstileCaptcha::isCaptchaLegit($response)`: Validates a specific CAPTCHA response and returns a boolean.

---

## Usage Example

### Page Code

Below is an example of how to use the Turnstile CAPTCHA in a contact form:

```htm
title = "Contact Us"
url = "/contact"
layout = "default"
is_hidden = 0

[turnstileCaptcha]

==
use Depcore\Turnstile\Components\TurnstileCaptcha;

function onFormSubmit()
{
    // Option 1: Use the custom validation rule
    $data = post();
    $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required',
        'cf-turnstile-response' => 'required|turnstile', // Use the custom validation rule
    ];

    $validator = Validator::make($data, $rules);

    if ($validator->fails()) {
        throw new ValidationException($validator);
    }

    // Option 2: Manually verify the CAPTCHA
    if (!TurnstileCaptcha::checkLegit()) {
        throw new ValidationException(['captcha' => 'CAPTCHA validation failed. Please try again.']);
    }

    // Process the form data here (e.g., save to database, send email, etc.)

    return [
        'success' => 'Thank you for contacting us! We will get back to you soon.'
    ];
}
==

{% if success %}
<h1>
    {{ success }}
</h1>
{% endif %}

<!-- Contact Form -->
<form data-request="onFormSubmit" data-request-flash>
    {% component "turnstileCaptcha" %}
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
    </div>
    <div>
        <label for="message">Message:</label>
        <textarea name="message" id="message" required></textarea>
    </div>
    <button type="submit">Submit</button>
</form>
```

### Explanation

- **`[turnstileCaptcha]`**: This line includes the Turnstile CAPTCHA component in your form.
- **`cf-turnstile-response`**: This is the default field name for the CAPTCHA response. It is automatically added by the Turnstile widget.
- **`turnstile` Validation Rule**: The custom validation rule checks if the CAPTCHA response is valid. If not, it throws a validation error.
- **`TurnstileCaptcha::checkLegit()`**: This method checks if the CAPTCHA response is valid. It returns `true` if the CAPTCHA is verified, otherwise `false`.
- **`TurnstileCaptcha::isCaptchaLegit($response)`**: This method validates a specific CAPTCHA response and returns a boolean.
- **`data-request="onFormSubmit"`**: This attribute specifies the AJAX handler to be called when the form is submitted.
- **`data-request-flash`**: This attribute enables flash messages to be displayed after form submission.

---

## Configuration

### Settings Page

To configure the plugin:

1. Go to the OctoberCMS backend.
2. Navigate to **Settings > Turnstile Captcha**.
3. Enter your **Site Key** and **Secret Key** (obtained from Cloudflare's Turnstile dashboard).

### Component

The `turnstileCaptcha` component is simple to use and does not require additional options. Simply include it in your form:

```htm
[turnstileCaptcha]
```

---

## Manual CAPTCHA Verification

The plugin provides two methods for manually verifying CAPTCHA responses:

1. **`TurnstileCaptcha::checkLegit()`**:
   This method checks the CAPTCHA response included in the form submission. It returns `true` if the CAPTCHA is verified, otherwise `false`.

   Example:
   ```php
   if (!TurnstileCaptcha::checkLegit()) {
       throw new ValidationException(['captcha' => 'CAPTCHA validation failed. Please try again.']);
   }
   ```

2. **`TurnstileCaptcha::isCaptchaLegit($response)`**:
   This method validates a specific CAPTCHA response. Pass the `cf-turnstile-response` value to this method, and it will return `true` if the CAPTCHA is verified, otherwise `false`.

   Example:
   ```php
   $response = post('cf-turnstile-response');
   if (!TurnstileCaptcha::isCaptchaLegit($response)) {
       throw new ValidationException(['captcha' => 'CAPTCHA validation failed. Please try again.']);
   }
   ```

---

## Troubleshooting

- **CAPTCHA Not Displaying**: Ensure that the Site Key and Secret Key are correctly entered in the settings page.
- **Validation Fails**: Verify that the `cf-turnstile-response` field is included in your form and that the `turnstile` validation rule or manual verification method is applied.

---

## Notes for Internal Use

- This plugin is designed specifically for internal use and is not intended for public distribution.
- The plugin is lightweight and integrates seamlessly with OctoberCMS's existing functionality.
- If additional features or customizations are needed, they can be implemented as required.

---

## License

This plugin is proprietary and is intended for internal use only. Unauthorized distribution or use is prohibited.

---

If you have any questions or need further assistance, feel free to reach out to the development team.
