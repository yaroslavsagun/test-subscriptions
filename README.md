# Subscriptions in Laravel

## 1. Installation

This app uses default laravel sail package for easy deploy in containers using docker-compose

<br/>

#### Clone github repo

```
git clone https://github.com/yaroslavsagun/test-subscriptions.git
```

#### Rename .env file and install dependencies

```
mv .env.example .env
composer install
```

#### Run docker-compose using sail

```
sail up -d
```

#### Generate Laravel key, migrate and seed DB

```
sail artisan key:generate
sail artisan migrate
sail artisan db:seed
```

## Usage

Now the app is available on `localhost:80`

## Login credentials:
- email: `john.doe@gmail.com`
- password: `12345678`

## About app

App works with subscriptions. User can change subscription, payment frequency or number of users in his company.
Additionally, I implemented ProcessPaymentCommand which is scheduled to run every day and process payments for users.

## Why sail

I've chosen laravel sail default package to quickly deploy app using in-build docker-compose.
Usually I use it only for local development, while prod/dev environment
is run using classic docker-compose command.

