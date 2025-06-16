# Settings

## Accessing Settings

Go to **Settings > Turnstile Captcha** in the OctoberCMS backend.

## Options

- **Site Key**: Your Cloudflare Turnstile site key (used in frontend widget)
- **Secret**: Your Cloudflare Turnstile secret key (used for backend verification)

## How Settings Are Used

- The component reads the site key to render the widget.
- The backend uses the secret to verify responses.

**Example fields.yaml:**
```yaml
site_key:
    label: Site Key
    comment: Key for turnstile widget
    type: text
secret:
    label: Secret
    comment: Secret used to verify turnstile request on the backend
    type: text
```
