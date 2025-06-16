<?php namespace Depcore\Turnstile\Models;

use Model;

/**
 * CaptchaSettings SettingModel
 *
 * @link https://docs.octobercms.com/3.x/extend/settings/model-settings.html
 */
class CaptchaSettings extends \System\Models\SettingModel
{
    /**
     * @var string settings code
     */
    public $settingsCode = 'depcore_turnstile_captcha_settings';

    public $settingsFields = 'fields.yaml';
}
