## SIAP Undip Clone

### Installation

- Clone this repository and install all dependency first

```
git clone https://github.com/karindralinux/siap-undip-clone.git
cd siap-undip-clone
composer install
```

- Setup the database by copying .env.example file and renamed it into .env. Then, set your configuration included database configuration

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=siap_undip
DB_USERNAME=root
DB_PASSWORD=

```

- Generate the laravel key after that.

```
php artisan key:generate
php artisan jwt:secret
```

- After you setup the database, run the migration and seeder

```
php artisan migrate
php artisan db:seed
```

- Run the server and it was ready to use

```
php artisan serve
```

