### Laravel Console

Laravel Console is a handy tool that lets you debug your Laravel application in a *JavaScript-style* manner. Logs appear directly in your browser's DevTools panel — without interrupting code execution.

**Table of Contents**
* [Prerequisites](#prerequisites)
* [Getting Started](#getting-started)
* [Usage](#usage)

----------
#### Prerequisites
Requires **[Laravel 12.x](https://laravel.com/docs/12.x)** and **PHP 8.2+**.

#### Getting Started
Install the package via Composer:
```sh
composer require redberry/laravel-console --dev
```

The package is auto-discovered by Laravel's package discovery, so no manual registration is needed.

> **Laravel 11+ note:** If you have disabled package auto-discovery, add the service provider to your `bootstrap/providers.php` file:
> ```php
> return [
>     // ...
>     Redberry\LaravelConsole\ServiceProvider::class,
> ];
> ```

Then install the [Laravel Console](https://chrome.google.com/webstore/detail/laravel-console/eikhhbiadcdalcbppkfppnlmhhmcmanp) Chrome extension and you're good to go. :blush:

#### Usage

Use the `Console` facade to log from anywhere in your application:
```php
use Redberry\LaravelConsole\Facades\Console;

Console::emergency('hi there!');
Console::alert     ('hi there!');
Console::critical  ('hi there!');
Console::error     ('hi there!');
Console::warning   ('hi there!');
Console::notice    ('hi there!');
Console::info      ('hi there!');
Console::log       ('hi there!');
```

Or use the `console()` helper function:
```php
console()->emergency('hi there!');
console()->alert    ('hi there!');
console()->critical ('hi there!');
console()->error    ('hi there!');
console()->warning  ('hi there!');
console()->notice   ('hi there!');
console()->info     ('hi there!');
console()->log      ('hi there!');
```

#### Blade Directives

You can also log directly from Blade templates:

```blade
{{-- Log a single value --}}
@log($user)

{{-- Log all variables available in the current view --}}
@explain
```

Happy logging :yum:
