<?php

namespace Depcore\Turnstile\Classes;

use Depcore\Turnstile\Components\TurnstileCaptcha;

/**
 * Class TurnstileRule
 *
 * Provides a validation rule for verifying Turnstile CAPTCHA responses.
 *
 * This rule can be used in form validation to ensure that the submitted CAPTCHA
 * response is valid by delegating the verification to the TurnstileCaptcha component.
 *
 * @package Depcore\Turnstile\Classes
 */
class TurnstileRule
{
    /**
     * Determines if the validation rule passes.
     *
     * This method checks if the provided CAPTCHA value is legitimate by calling
     * the TurnstileCaptcha::isCaptchaLegit method.
     *
     * @param string $attribute The name of the attribute under validation.
     * @param mixed $value The value of the attribute under validation (CAPTCHA response token).
     * @param array $params Additional parameters for the validation rule (unused).
     * @return bool Returns true if the CAPTCHA is valid, false otherwise.
     */
    public function validate($attribute, $value, $params)
    {
        return TurnstileCaptcha::isCaptchaLegit($value);
    }

    /**
     * Gets the validation error message.
     *
     * This message will be returned if the CAPTCHA validation fails.
     *
     * @return string The error message for invalid CAPTCHA.
     */
    public function message()
    {
        return 'The :attribute is not a valid CAPTCHA.';
    }
}
