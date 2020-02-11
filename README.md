# Laravel Cypress ☄️


Easily Bootstrap your Laravel application with Cypress helpers to get you up and running with Cypress testing quickly.

## Documentation

### Install
You can install this package through composer. Make sure to request this package as Dev Dependency only, to avoid any potential security risks. 

`composer require mabadir/laravel-cypress --dev`

Then you need to publish the config file through:

`php artisan vendor:publish`

### Configuration
1. First ensure you have configured the URL that you will use for your Cypress Acceptance testing. Usually this URL is something like `acceptance.example.test`. In your `.env` file add an entry:

    `CYPRESS_URL=acceptance.example.test`

2. This package supports swapping the Database on the fly in order to keep your `local` database clean from acceptance testing data. The database needs to be using the `local` database connection. Add this entry to `.env`:

    `CYPRESS_DB=acceptance`
    
3. Add Cypress commands to `cypress/support/commands.js` by running the command:

    `php artisan cypress:publish`
    
### Usage
This package by default offers the following routes:

| Route                                | Description                                                                                                                                |
|--------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------|
| `__testing__/create/{model}`         | Creates a model using its factory. Package assumes the model is namespaced under App\                                                      |
| `__testing__/create/{model}/{count}` | Creates an array of model and returns then in JSON array.                                                                                  |
| `__testing__/login/{model?}`         | Creates a model and authenticates the resulted object. The model name is optional and defaults to User. The model has to be Authenticable. |
| `__testing__/migrate`                | This route basically runs `php artisan migrate:refresh`                                                                                    |
    
You can extend or override the built in routes, by creating a new routes file in your app `routes/acceptance.php`. Adding any routes to this file will make them available to your `acceptance` domain name only. All routes are prefixed by `/__testing__/`

### Security

If you discover any security related issues, please email mina@abadir.email instead of using the issue tracker.


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.