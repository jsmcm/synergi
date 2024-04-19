<p align="center"><img src="https://www.synergicode.com/assets/img/logo.svg" width="400" alt="SynergiCode Logo"></p>

## Project Overview

A simple application to allow a client to capture their name, email and optionally a comment or additional information. The user's name and email are required and must be valid. The comment is optional.

Once a client has submitted their information a welcome email is sent to them and they are redirected to a thank you page.

Administrative users can add or edit users. When an adminstrative user adds a new client a welcome email is also sent.

A user (whether client or admin) can log in to edit their profile info and change their password.

## Technical Details

This project uses Laravel and Intertia with VueJs. The project was created with breeze to automatically create the user/auth functionality as well as installing and configuring Inertia and VueJs automatcally with "laravel new synergi --breeze".

It has two models, User and Comment and subsequently two database tables (users and comments). The User modal has a "hasMany" relationship with the Comment modal, and a Comment modal has a "belongsTo" relationship with a User modal.

There is a UserRequest validation class in app\Http\Requests to validate form submissions. There are also other Request classes in this directory provided by Laravel during setup.

When a new User modal is created it fires a UserCreated event. There is a NotifyUserOfRegistration listener which listens for these events. This listener triggers a UserRegistered notification which sends the user welcome email.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
