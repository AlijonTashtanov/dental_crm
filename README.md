## Adminlte starter kit

•	Author: [Ulugbek](https://github.com/Ulugbek-Muhammadjonov) <br>
•	Telegram: [@U_Muhammadjonov](https://t.me/@U_Muhammadjonov) <br>

## Usage <br>
Setup your coding environment <br>
```
git clone https://github.com/iTeach-uz/rmab-backend.git
cd adminlte
composer install
npm install
npm run build
cp .env.example .env 
php artisan key:generate
php artisan migrate
php artisan cache:clear && php artisan config:clear 
```

## Database Setup <br>
We will be performing database tests which (obviously) needs to interact with the database. Make sure that your database credentials are up and running.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=adminlte
DB_USERNAME=root
DB_PASSWORD=
```

Next up, we need to create the database which will be grabbed from the ```DB_DATABASE``` environment variable.
```
mysql;
create database adminlte;
exit;
```

Postgres database setup <br>
.env file setup
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=adminlte
DB_USERNAME=postgres
DB_PASSWORD=postgres
```
Create database with terminal
```
psql postgres;
CREATE DATABASE adminlte;
\q
```
