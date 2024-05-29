<p align="center"><img src="/public/images/banners/auth-light.png" alt="Auth"></p>

# Laravel Auth Boilerplate

Laravel fully developed auth boilerplate for your next project

## Installation & Setup

To install & setup the boilerplate, please first clone the repo by using below command:

```bash
git clone https://github.com/theshreyanshpanchal/laravel-auth-boilerplate.git
```

PLease perform the below commands to setup the boilerplate:

```bash
php artisan migrate # It will migrate the required tables.

php artisan db:seed # It will seed the default Admin user.
```

## Additional

Additionally we have used the our own package [Atlas](https://github.com/theshreyanshpanchal/atlas) for the comprehensive global data.

Please run the below command to setup the Atlas.

```bash
# It will setup the atlas to serve comprehensive global data.
# We have just enabled the 'Countries' facility for now.

php artisan atlas:install
```

## Features Available

✅ Registration

✅ Login (With user lockout feature - It will lockout the user on multiple invalid attempts.)

✅ Remember Me

✅ Profile Management

✅ Password Reset

✅ Email Verification (Common multi-purpose module for the email verification.)

✅ Role Permissions Management (Role and permission based common dashboard and modules.)

✅ Browser Sessions Management (let users see where they’re connected and logout sessions.)

## Credits

- [Shreyansh Panchal](https://github.com/theshreyanshpanchal)
- [Infynno Solutions LLP](https://infynno.com)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.
