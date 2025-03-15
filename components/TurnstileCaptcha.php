<?php namespace Depcore\Turnstile\Components;

use Cms\Classes\ComponentBase;
use Depcore\Turnstile\Models\CaptchaSettings;
use Illuminate\Support\Facades\Http;

/**
 * TurnstileCaptcha Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class TurnstileCaptcha extends ComponentBase
{

    public static function isCaptchaLegit($turnstileResponse)
    {
        $secret = CaptchaSettings::get('secret');

        // Make the POST request to Cloudflare Turnstile API
        $response = Http::post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => $secret,
            'response' => $turnstileResponse
        ]);

        // Decode the JSON response
        $result = json_decode($response->body());

        // Return true if the CAPTCHA is valid, false otherwise
        return $result->success ?? false;
    }

    public static function checkLegit()
    {
        // Retrieve the CAPTCHA response from the form submission
        $turnstileResponse = post('cf-turnstile-response');

        // Verify the CAPTCHA
        return static::isCaptchaLegit($turnstileResponse);
    }

    public function onRender()
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

    public function onRun()
    {
        $this->addJs("https://challenges.cloudflare.com/turnstile/v0/api.js", ["defer"=>true, "async"=>true]);
    }
}
