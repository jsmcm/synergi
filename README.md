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

## Running the Code

To begin, clone this repo then in a terminal cd into the project folder (usually synergi).

Create an .env file. You can do this by copying the .env.example file to .env which will contain a logical starting point but you can override settings as required.

 and then type the following commands (order is important):

- composer install
- npm install
- npm run build
- php artisan migrate
- php artisan key:generate


To run the app (assuming you have not set up a running server) you can type **php artisan serve** and then navigate to the url it specifies in a browser.

**Note:** Your application will have no users. This will not prevent a user from registering at the home page (/) but it will prevent any logins. If you visited the login page (/login) it will show a page warning that there is no admin user. 

**Create your first admin user**. To create your first admin user use the artisan command as shown on the warning page. The command is:
  php artisan synergi:create_first_admin {name} {email} {password}

There is a user factory which you can use to seed your database with test info:
    examples:
    
    Create 3 client users:
    User::factory()->count(3)->create();
    
    Create 2 admin users:
    User::factory(2)->admin()->create();

**Config**
There are two config settings in config/synergi.php. These are:
 - countCacheTtl. This setting is the amount of time the admin user count is cached for. This is what checks if we show the user login page or the no admin user page. It can be used in code as **config("synergi.countCacheTtl")** and can be set in the .env file as **SYNERGI_USERS_COUNT_CACHE_TTL**. The default is 6 hours.
 - paginationSize. This sets the number of items to show in the user's listing when an admin logs in. It can be accessed in code by **config("synergi.paginationSize")** and can be set in the .env file as **SYNERGI_PAGINATION_SIZE**. The detail page size is 50.

## Additional Features

While the specification only called for a form for a user to submit data to the database and asked for simplicity I chose to go with a fuller app for 2 reasons:
- I already did a site (last week) for a different recruitment test which asked only for the admin side of things (there was no requirement for a user to add themselves). I do believe that reusing code is beter than starting from scratch each time (where its ok to do this given code ownership etc). In this case it was easy enough to clone and edit that code.
- Installing Inertia and VueJs is much easier using Laravel Breeze than trying to do it by hand and Breeze already gives us all the auth functionality.


## Testing

There are several tests using phpunit. These test that the application is running, that the user's form works and that once the form is submitted it actually creates the new user modal. There are also tests to ensure that each user is unique.

**Note:** these tests are not exhaustive, there could be many more but these do demonstrate the important ones. Many other tests while necessary in a production application would be mostly copies of these.
