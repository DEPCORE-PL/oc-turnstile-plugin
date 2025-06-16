# Troubleshooting

## CAPTCHA Not Displaying

- Ensure your **Site Key** is set in the backend settings.
- Check for JavaScript errors in the browser console.

## Validation Fails

- Make sure the `cf-turnstile-response` field is present in your form.
- Ensure the `turnstile` validation rule is applied or use manual verification.

## Network Issues

- The plugin requires outgoing HTTPS requests to Cloudflare. Check your server firewall.

## Debugging

- Log the response from `TurnstileCaptcha::isCaptchaLegit()` for more details.
