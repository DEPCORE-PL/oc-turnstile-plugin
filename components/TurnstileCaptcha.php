<?php namespace Depcore\Turnstile\Components;

use Cms\Classes\ComponentBase;
use Depcore\Turnstile\Models\CaptchaSettings;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Event;
use October\Rain\Exception\ValidationException;

/**
 * TurnstileCaptcha component class.
 *
 * This component integrates the Cloudflare Turnstile CAPTCHA into your application,
 * providing bot protection for forms and other user interactions.
 *
 * @package depcore.turnstile
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class TurnstileCaptcha extends ComponentBase
{
    public function defineProperties()
    {
        return [
            'submissionAlias' => [
                'title' => 'Submission component alias',
                'description' => 'Alias of the User Submission component protected by Turnstile.',
                'type' => 'string',
                'default' => '',
            ],
        ];
    }

    /**
     * Validates the legitimacy of a Turnstile CAPTCHA response.
     *
     * This static method checks whether the provided Turnstile CAPTCHA response token
     * is valid and has been successfully verified. It is typically used to prevent
     * automated submissions and ensure that the request is made by a human user.
     *
     * @param string $turnstileResponse The response token received from the Turnstile CAPTCHA widget.
     * @return bool Returns true if the CAPTCHA response is valid; otherwise, false.
     */
    public static function isCaptchaLegit($turnstileResponse)
    {
        if (
            !is_string($turnstileResponse) ||
            trim($turnstileResponse) === '' ||
            strlen($turnstileResponse) > 2048
        ) {
            return false;
        }

        $secret = CaptchaSettings::get('secret');

        if (!$secret) {
            return false;
        }

        try {
            // Make the POST request to Cloudflare Turnstile API
            $response = Http::asForm()
                ->timeout(10)
                ->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                    'secret' => $secret,
                    'response' => $turnstileResponse,
                    'remoteip' => request()->ip()
                ]);
        } catch (\Throwable $e) {
            return false;
        }

        if (!$response->successful()) {
            return false;
        }

        // Decode the JSON response
        $result = $response->json();

        // Return true if the CAPTCHA is valid, false otherwise
        return (bool) ($result['success'] ?? false);
    }

    /**
     * Checks if the current request is legitimate.
     *
     * This static method performs validation to determine whether the request
     * passes the necessary legitimacy checks, such as verifying CAPTCHA responses
     * or other anti-bot mechanisms.
     *
     * @return bool Returns true if the request is legitimate, false otherwise.
     */
    public static function checkLegit()
    {
        // Retrieve the CAPTCHA response from the form submission
        $turnstileResponse = post('cf-turnstile-response');

        // Verify the CAPTCHA
        return static::isCaptchaLegit($turnstileResponse);
    }

    public function init(): void
    {
        $submissionAlias = trim((string) $this->property('submissionAlias'));

        if ($submissionAlias === '') {
            return;
        }

        Event::listen('cms.form.beforeSubmit', function ($component, $model) use ($submissionAlias) {
            if ($component->alias !== $submissionAlias) {
                return;
            }

            if (!static::checkLegit()) {
                throw new ValidationException([
                    'cf-turnstile-response' => 'Turnstile validation failed.'
                ]);
            }
        });
    }

    /**
     * Handles the rendering of the Turnstile CAPTCHA component.
     *
     * This method is typically called to generate and display the CAPTCHA widget
     * on the frontend. It prepares any necessary data and returns the rendered output.
     *
     * @return void
     */
    public function onRender(): void
    {
        $this->page["site_key"] = CaptchaSettings::get('site_key');
    }

    public function componentDetails()
    {
        return [
            'name' => 'Turnstile Captcha Component',
            'description' => 'Verifies user authenticity by providing a captcha'
        ];
    }


    /**
     * Applies the necessary scripts to make turnstile work
     *
     * This method loads the turnstile script with an additional fix for reloading after failed validation
     *
     * @return void
     */
    public function onRun()
    {
        $this->addJs("https://challenges.cloudflare.com/turnstile/v0/api.js", ["defer"=>true, "async"=>true]);
        $this->addJs('assets/js/resetValidate.js');
    }
}
