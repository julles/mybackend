# My Backend

Admin panel untuk laravel 5.2

### Fiture :

- Role Access Management
- Minimalis Crud Code
- Login
- Forgot Password
- Etc

### Cara install

clone project atau download source mybackend

```sh
clone https://github.com/julles/mybackend.git
```

copy file .env.example menjadi .env

``` sh
cp .env.example .env
```
setting koneksi database di file .env

``` sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mybackend
DB_USERNAME=root
DB_PASSWORD=terserahdikau
```



install depedencies

``` sh
composer install
```

Jalan kan artisan command berikut :

``` sh
php artisan admin:install
```

By default url admin :

https://yoururl.dev/login

email : admin@admin.com

password : admin
