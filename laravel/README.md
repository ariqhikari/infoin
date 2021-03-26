<p align="center"><a href="https://infoin.auroraweb.id" target="_blank"><img src="https://raw.githubusercontent.com/ariqhikari/infoin/main/github/logo.png" width="150"></a></p>

## About Info.In Laravel

**Info.In** is the website for informs about COVID-19 and aims to provide social assistance to Indonesian people who need it. The advantages of this website are:

- Interactive [UI](https://en.wikipedia.org/wiki/User_interface).
- Easy to use.
- Easy access.
- Websites that have used [SPA](https://en.wikipedia.org/wiki/Single-page_application).

## Table of contents

+ [Installation](#installation)
+ [Default Account for testing](#default-account-for-testing)
+ [License](#license)

## Installation

Clone the repo:
```shell
git clone https://github.com/ariqhikari/infoin.git
cd laravel
```

Install composer packages:
```shell
composer install
```

After that, run all migrations and seed the database:
```shell
php artisan migrate:refresh --seed
```

Then, edit your .env, and run your application:
```shell
php artisan serve
```

Visit
[http://yoursite.com/login](https://yoursite.com/login)


## Default Account for testing
	
**Admin Default Account**
- Email : admin@gmail.com 
- Password : admin123456

**Event Organizer Default Account**
- Email : eo@gmail.com
- Password : eo123456

**User Default Account**
- Email : user@gmail.com
- Password : user123456

## License

The project is under the [MIT license](https://github.com/ariqhikari/infoin/blob/main/LICENSE).