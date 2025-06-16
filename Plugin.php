<?php namespace Depcore\Turnstile;
use Depcore\Turnstile\Classes\TurnstileRule;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    public function register()
    {
        /**
         * Register a custom validation rule for Turnstile captcha.
         * This rule can be used in forms to validate Turnstile captcha responses.
         */
        $this->registerValidationRule('turnstile', TurnstileRule::class);
    }

    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'Turnstile',
            'description' => 'Adds a Turnstile captcha framework',
            'author' => 'Depcore',
            'icon' => 'icon-leaf'
        ];
    }

    public function registerSettings()
    {
        /**
         * Register settings for the Turnstile captcha.
         * This allows users to configure the captcha settings from the backend.
         */
        return [
            'settings' => [
                'label' => 'Captcha Settings',
                'description' => 'Manage Turnstile Captcha settings.',
                'category' => 'CATEGORY_USERS',
                'icon' => 'icon-lock',
                'class' => \Depcore\Turnstile\Models\CaptchaSettings::class,
            ]
        ];
    }

    public function boot()
    {
        /**
         * Include the TurnstileRule class for custom validation.
         * This class implements the logic for validating Turnstile captcha responses.
         */
        include __DIR__ . '/classes/TurnstileRule.php';
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return [
            \Depcore\Turnstile\Components\TurnstileCaptcha::class => 'turnstileCaptcha',
        ];
    }
}
