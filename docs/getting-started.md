# Getting Started

## Installation

1. Place the plugin in your OctoberCMS plugins directory:
   ```
   plugins/depcore/turnstile
   ```
2. Run migrations if required:
   ```
   php artisan october:up
   ```
3. Go to **Settings > Turnstile Captcha** in the backend and enter your Cloudflare Turnstile **Site Key** and **Secret Key**.

## Requirements

- OctoberCMS 3.x
- PHP 8.0+
- Composer dependencies installed

## Updating

To update, pull the latest code and run migrations if needed:
```
php artisan october:up
```
