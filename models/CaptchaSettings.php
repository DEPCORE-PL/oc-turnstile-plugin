<?php namespace Depcore\Turnstile\Models;

use Model;

/**
 * CaptchaSettings Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class CaptchaSettings extends \System\Models\SettingModel
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $settingsCode = 'depcore_turnstile_captcha_settings';

    public $settingsFields = 'fields.yaml';

    /**
     * @var array rules for validation
     */
    public $rules = [];
}
