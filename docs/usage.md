# Usage

## Adding CAPTCHA to a Form

1. **Add the component to your page:**
   ```ini
   [turnstileCaptcha]
   ```

2. **Insert the component in your form:**
   ```html
   {% component "turnstileCaptcha" %}
   ```

3. **Add the CAPTCHA validation to your handler:**
   ```php
   use Depcore\Turnstile\Components\TurnstileCaptcha;

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

       // Or, manual check:
       if (!TurnstileCaptcha::checkLegit()) {
           throw new ValidationException(['captcha' => 'CAPTCHA validation failed.']);
       }

       // Process form...
   }
   ```

## Field Name

The Turnstile widget automatically adds a field named `cf-turnstile-response` to your form.

## AJAX Forms

Use `data-request="onFormSubmit"` and `data-request-flash` for AJAX-enabled forms.

## Example Form

```html
<form data-request="onFormSubmit" data-request-flash>
    {% component "turnstileCaptcha" %}
    <!-- your fields -->
    <button type="submit">Submit</button>
</form>
```
