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
