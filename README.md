## Laravel Ace

Pre-requisites:
This was tested with php 7.3


1. composer install

2. Setup your .env
You can copy the .env.development into your .env file

3. Setup google map api key in your .env file
GOOGLE_MAP_API_KEY=

4. Setup the application
run this command:
$ php artisan setup:app
if everything goes well, you will get a response like this:

This command will:
- check if you have setup google api key (but will not test it)
- refresh the database
- generate an admin account : admin@laravel.com / password
- install laravel passport
- import customers and setup their geolocations

4. Configure Cache (optional)
Configure cache from .env
You can recommended to use redis but you can use file (or database) for testing purposes if you dont have redis setup
CACHE_DRIVER=redis

5. Configure testing environment .env.testing

A. Setup your testing database and specify this inside the .env.testing file
B. Setup google map api key like before in the .env file
C. Complete setup for the testing environment
php artisan setup:testing --env=testing

6. Run tests:
php artisan test

7. In order to test the API, the login is :
email: admin@laravel.com
password: password

8. You will find the postman.json in the folder, that is the postman collection used to test the endpoints.


Using Docker :
1. Setup laravel sail here - https://laravel.com/docs/8.x/sail

2. Setup your .env
You can copy the .env.development into your .env file

3. Setup google map api key in your .env file
GOOGLE_MAP_API_KEY=

4. Run sail up
$ sail up

5. Run the command
$ sail composer install

6. Setup the application properly
$ sail php artisan setup:app

7. Running your test on sail
$ sail artisan test
