<?php

namespace Depcore\Turnstile\Classes;

use Depcore\Turnstile\Components\TurnstileCaptcha;

class TurnstileRule
{
    /**
     * validate determines if the validation rule passes.
     * @param string $attribute
     * @param mixed $value
     * @param array $params
     * @return bool
     */
    public function validate($attribute, $value, $params)
    {
        return TurnstileCaptcha::isCaptchaLegit($value);
    }

    /**
     * message gets the validation error message.
     * @return string
     */
    public function message()
    {
        return 'The :attribute is not a valid CAPTCHA.';
    }
}
