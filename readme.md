
<h2 align="center">Votvota</h2>
<h4 align="center">A simple and fast application for voting process.</h4>

<p align="center">
  <a href="#about">About App</a> •
  <a href="#key-features">Key Features</a> •
  <a href="#how-to-use">How To Use</a> •
  <a href="#license">License</a>
</p>

![screenshot](myFolder/image/sample.png)

## About

Voting for the election of the student council leader in the school environment is actually a simple thing and does not require complicated regulations. But in reality the implementation of this activity looks very complicated. Therefore, Votvota is here to bring convenience in voting to the final vote calculation.

## Key Features

* Administrator
  - Auth
  - Crete a custom voting.
  - Determine the time for voting
  - Choice and set the candidate for leader and co leader
  - Watch progress current voting
  - Stop current voting
  - View voting history
* Student
  - Auth
  - Vote to candidate

## How To Use

To clone and run this application, you'll need [Git](https://git-scm.com) and [XAMPP](https://www.apachefriends.org/download.html) installed on your computer. From your command line:

```bash
# Clone this repository
$ git clone https://github.com/2-Q/votvota

# Go into the repository
$ cd votvota

# Install dependencies
$ composer install

# Init .Env
$ copy .env.example .env

# Setup app
$ php artisan key:generate
$ php artisan migrate --seed

# Run the app
$ php artisan serve
```

## License

The MIT License (MIT) 2020 - [Dwiki Mukti](https://github.com/2-Q/).



