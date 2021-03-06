<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## My docs

### Run

php artisan serve

Note:
- https://viblo.asia/p/debug-request-laravel-voi-xdebug-va-vscode-naQZRWgqlvx

### Database migration

php artisan migrate:install
php artisan migrate
php artisan make:migration create_flights_table
php artisan migrate:rollback
php artisan migrate:reset


### Eloquent

php artisan make:model Customer -mfsc
//t???o model ?????ng th???i t???o th??m c??? migration, factory, seed v?? controller c??c b???n c?? th??? s??? d???ng flag -mfsc.( gi????ng c??u l????nh tr??n)

Schema::create('customers', function (Blueprint $table) {
    $table->id();
    $table->string('email', 128);
    $table->string('name', 128);
    $table->string('password', 128);
    $table->string('phone', 32);
    $table->smallInteger('status');
    $table->timestamps();
});

php artisan make:model Hotel -mfsc
    $table->id();
    $table->string('name', 128);
    $table->string('address', 128);    
    $table->Integer('rooms', 32);
    $table->string('phone', 32);
    $table->smallInteger('status');
    $table->timestamps();

php artisan make:model Room -mfsc

Schema::create('room', function (Blueprint $table) {
    $table->id();
    $table->string('name', 128);
    $table->string('password', 128);
    $table->string('phone', 32);
    $table->smallInteger('status');
    $table->timestamps();
});




php artisan make:model Booking -mfsc

Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hotel_id')->unsigned();
            $table->string('name', 128);
            $table->string('description', 255);
            $table->smallInteger('floor');
            $table->smallInteger('number');
            $table->smallInteger('bed');
            $table->tinyInteger('status');
            $table->timestamps();
            
            $table->foreign('hotel_id')->references('id')->on('hotels');
        });

        h1>NTT UNION</h1>

## T???ng quan

<h3>C??ng ngh???, ng??n ng??? s??? d???ng:</h3>

- PHP : 7.4 (Laravel 8.x)
- Nodejs : 15.x
- PostgreSql : 12.6
- Proxy: Nginx  : 1.19

<h3>Skills c???n c??:</h3>

- PHP Laravel framework
- SASS style : [Tham kh???o](https://sass-lang.com/guide)
- Javascript, Jquery 

<h3>C???u tr??c th?? m???c l??m vi???c ch??nh:</h3>

- <b>App\Http\Controllers</b> : ??i???u h?????ng x??? l?? d??? li???u sau khi nh???n d??? li???u t??? request r???i g???i services ????? x??? l?? logic.
    + Admin
    + User
- <b>App\Http\Requests</b>: Define validate v?? x??? l?? d??? li???u ?????u v??o.
- <b>App\Repositories</b> : X??? l?? query builder ????? services s??? d???ng.
- <b>App\Services</b> : X??? l?? logic sau khi nh???n d??? li???u t??? repository.
- <b>App\Utilities</b> : X??? l?? logic ?????c l???p g???i ki???u static.
- <b>resources\build</b> : Ch???a code js v?? style.
    + css
        + admin
        + user
    + js
        + admin
        + user
- <b>resources\views</b> : Ch???a blade file.
    + admin
    + user
        + mobile
        + pc
- <b>routes</b> : Ch???a config ??i???u h?????ng d???a tr??n URL.
- <b>setupEnv</b> : To??n b??? file c??i ?????t tr??n m???i tr?????ng dev.

<h3>T??nh n??ng, packages b??? sung:</h3>

- laravel-snappy : x??? l?? file pdf + image.
    + [Document](https://github.com/barryvdh/laravel-snappy#usage)
- guzzle : l???y d??? li???u th??ng qua Http request.
    + [Document](https://laravel.com/docs/8.x/http-client)

## C??i ?????t m??i tr?????ng DEV

<h3>V???i m??i tr?????ng ph??t tri???n y??u c???u b???t bu???c:</h3>

- Docker : [C??i ?????t](https://docs.docker.com/engine/install/)
- Docker-compose : [C??i ?????t](https://docs.docker.com/compose/install/)

<h3>H?????ng d???n c??i ?????t.</h3>

- *Step 1:* 
bash
    $ cd source\setupEnv


- *Step 2: Run docker container.*
bash
    $ docker-compose up -d


- *Step 3: C??i ?????t host local.*

B??? sung 2 d??ng sau v??o cu???i file hosts.
$xslt
127.0.0.1 ntt-user.local
127.0.0.1 ntt-admin.local


+ Window : C:\Windows\System32\drivers\etc\hosts
+ Ubuntu : sudo vim /etc/hosts
+ MacOS : sudo vim /etc/hosts

- *Step 4: C??i ?????t g??i th?? vi???n*

Th???c hi???n theo th??? t??? sau:

bash
    $ cd source\setupEnv

   + Truy c???p container workspace.
bash
    $ docker-compose exec workspace bash

   + T???i packages php.
bash
    $ composer install

   + T???i packages node.
bash
    $ npm install


   + Compiler code js v?? code style (m???i l???n s???a file js v?? style ?????u ch???y l???i l??nh n??y).
bash
    $ npm run dev


   + Ch???y migrate database structure + data seeder.
bash
    $ php artisan migrate --seed


## Coding convention
p

## Ch?? ??:

- M???i thao t??c li??n quan ?????n source ?????u ph???i thao t??c trong container workspace:
   
   *=> Truy c???p container workspace.*
bash
    $ docker-compose exec workspace bash

