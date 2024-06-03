<p align="center"><img src="/public/images/banners/auth-light.png" alt="Auth"></p>

# Laravel Auth Boilerplate

Laravel fully developed auth boilerplate for your next project

## Installation & Setup

Start by cloning the repository:

```bash
git clone https://github.com/theshreyanshpanchal/laravel-auth-boilerplate.git
```

Run the following commands to migrate the required tables and seed the default admin user:

```bash
php artisan migrate # Migrate the required tables.

php artisan db:seed # Seed the default admin user.

php artisan sync:permission # Sync the permissions with admin user.

php artisan sync:stripe-products # Sync the stripe plans with system.

# Note: For sync the stripe products, You need to provide the STRIPE_KEY, STRIPE_SECRET & CASHIER_CURRENCY in .env file. See the .env.example for more details.
```

## Additional Setup

This project uses the [Atlas](https://github.com/theshreyanshpanchal/atlas) package for comprehensive global data. To set up Atlas, run:

Please run the below command to setup the Atlas.

```bash
php artisan atlas:install # Set up Atlas to serve comprehensive global data (currently enabled for 'Countries').
```

## Features Available

✅ Registration

✅ Login (with user lockout feature for multiple invalid attempts)

✅ Remember Me

✅ Profile Management

✅ Reset Password

✅ Change Password

✅ Email Verification (common multi-purpose module)

✅ Role Permissions Management (role and permission-based common dashboard and modules)

✅ Browser Sessions Management (let users see their active sessions and logout if necessary)

## More Additional Features

✅ Laravel cashier/stripe integration

✅ Subscription (recurring payments)

✅ Product purchase (one time payments)

## Credits

- [Shreyansh Panchal](https://github.com/theshreyanshpanchal)
- [Infynno Solutions LLP](https://infynno.com)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.
