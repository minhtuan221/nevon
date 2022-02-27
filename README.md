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
//tạo model đồng thời tạo thêm cả migration, factory, seed và controller các bạn có thể sử dụng flag -mfsc.( giống câu lệnh trên)

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

## Tổng quan

<h3>Công nghệ, ngôn ngữ sử dụng:</h3>

- PHP : 7.4 (Laravel 8.x)
- Nodejs : 15.x
- PostgreSql : 12.6
- Proxy: Nginx  : 1.19

<h3>Skills cần có:</h3>

- PHP Laravel framework
- SASS style : [Tham khảo](https://sass-lang.com/guide)
- Javascript, Jquery 

<h3>Cấu trúc thư mục làm việc chính:</h3>

- <b>App\Http\Controllers</b> : Điều hướng xử lý dữ liệu sau khi nhận dữ liệu từ request rồi gọi services để xử lý logic.
    + Admin
    + User
- <b>App\Http\Requests</b>: Define validate và xử lý dữ liệu đầu vào.
- <b>App\Repositories</b> : Xử lý query builder để services sử dụng.
- <b>App\Services</b> : Xử lý logic sau khi nhận dữ liệu từ repository.
- <b>App\Utilities</b> : Xử lý logic độc lập gọi kiểu static.
- <b>resources\build</b> : Chứa code js và style.
    + css
        + admin
        + user
    + js
        + admin
        + user
- <b>resources\views</b> : Chứa blade file.
    + admin
    + user
        + mobile
        + pc
- <b>routes</b> : Chứa config điều hướng dựa trên URL.
- <b>setupEnv</b> : Toàn bộ file cài đặt trên mồi trường dev.

<h3>Tính năng, packages bổ sung:</h3>

- laravel-snappy : xử lý file pdf + image.
    + [Document](https://github.com/barryvdh/laravel-snappy#usage)
- guzzle : lấy dữ liệu thông qua Http request.
    + [Document](https://laravel.com/docs/8.x/http-client)

## Cài đặt môi trường DEV

<h3>Với môi trường phát triển yêu cầu bắt buộc:</h3>

- Docker : [Cài đặt](https://docs.docker.com/engine/install/)
- Docker-compose : [Cài đặt](https://docs.docker.com/compose/install/)

<h3>Hướng dẫn cài đặt.</h3>

- *Step 1:* 
bash
    $ cd source\setupEnv


- *Step 2: Run docker container.*
bash
    $ docker-compose up -d


- *Step 3: Cài đặt host local.*

Bổ sung 2 dòng sau vào cuối file hosts.
$xslt
127.0.0.1 ntt-user.local
127.0.0.1 ntt-admin.local


+ Window : C:\Windows\System32\drivers\etc\hosts
+ Ubuntu : sudo vim /etc/hosts
+ MacOS : sudo vim /etc/hosts

- *Step 4: Cài đặt gói thư viện*

Thực hiện theo thứ tự sau:

bash
    $ cd source\setupEnv

   + Truy cập container workspace.
bash
    $ docker-compose exec workspace bash

   + Tải packages php.
bash
    $ composer install

   + Tải packages node.
bash
    $ npm install


   + Compiler code js và code style (mỗi lần sửa file js và style đều chạy lại lênh này).
bash
    $ npm run dev


   + Chạy migrate database structure + data seeder.
bash
    $ php artisan migrate --seed


## Coding convention
p

## Chú ý:

- Mọi thao tác liên quan đến source đều phải thao tác trong container workspace:
   
   *=> Truy cập container workspace.*
bash
    $ docker-compose exec workspace bash

