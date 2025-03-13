# OctoberCMS Turnstile Captcha Plugin (Internal Use)

This plugin is designed for internal use within our organization. It integrates Cloudflare's Turnstile CAPTCHA into OctoberCMS projects, providing a simple and effective way to add CAPTCHA validation to forms. This ensures that form submissions are made by humans and not bots.

## Key Features

- **Turnstile CAPTCHA Integration**: Easily add Cloudflare's Turnstile CAPTCHA to any form.
- **Settings Page**: Manage your Turnstile site key and secret key directly from the OctoberCMS backend.
- **Component-Based**: Use the provided `turnstileCaptcha` component to add CAPTCHA to forms with minimal effort.
- **Validation**: Automatically validate CAPTCHA responses on form submission.

---

## How It Works

The plugin consists of two main parts:

1. **Settings Page**:
   A backend settings page where you can configure the Turnstile site key and secret key. These keys are stored using OctoberCMS's `SettingsModel`.

2. **Turnstile Component**:
   A reusable component (`turnstileCaptcha`) that can be added to any form. It handles the rendering of the CAPTCHA widget and validates the response on form submission.

---

## Usage Example

Below is an example of how to use the Turnstile CAPTCHA in a contact form:

### Page Code

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
    // Validate the CAPTCHA response
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
- **`TurnstileCaptcha::checkLegit()`**: This method checks if the CAPTCHA response is valid. It returns `true` if the CAPTCHA is verified, otherwise `false`.
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

## Troubleshooting

- **CAPTCHA Not Displaying**: Ensure that the Site Key and Secret Key are correctly entered in the settings page.
- **Validation Fails**: Verify that the `checkLegit()` method is called during form submission and that the CAPTCHA widget is correctly integrated into your form.

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
