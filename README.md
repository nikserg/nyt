# NYT

## Requirements

- Laravel Herd

OR

- PHP 8.2
- Composer

## Configuration

- Copy `.env.example` to `.env`
- Set `NYT_API_KEY` in `.env` to your API key from https://developer.nytimes.com/

You may also look at `config/nyt.php` to see other settings for API client.

## Running 

Project could be run with Laravel Herd (https://herd.laravel.com/)
or by running
```bash
composer install
php artisan serve
```
if you have local PHP.

## Usage

Use browser or Postman to send GET request to 

`http://<your host>/api/v1/bestsellers` 

All query parameters from NYT API are supported.
For example:

```
http://nyt.test/api/v1/bestsellers?author=King
http://nyt.test/api/v1/bestsellers?isbn[]=9780399169274&isbn[]=0671003542
http://nyt.test/api/v1/bestsellers?isbn=0671003542
http://nyt.test/api/v1/bestsellers?offset=40
```

## API HTTP Transport and caching

There are two HTTP transports available to access NYT's API: with caching and without.
They are binded in `\App\Providers\AppServiceProvider`. 
By default, caching transport is used.
Non-caching transport is commented out, developer may switch them.

Cache TTL is configured in `config/nyt.php`.

## API Client

API clients are stored in `app/NytApi/Client` directory. For now, 
only one client is implemented: `BestsellersClient`. New clients
may be easily added. 

Client uses configured transport to access API and then parse response into
DTO objects, stored in `app/NytApi/Response` directory.

Strictly speaking, this client should have its own Requests, but in sake 
of simplicity for current task, it uses just arrays, 
and validation of request is made on Controller level.

## Running tests

Use command 

```bash
php artisan test
```
