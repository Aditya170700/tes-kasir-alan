####Requirement
`php >= 8.1`
`node >= v16.13.2`
`npm >= 8.1.2`

####1. Instalation

Install dependencies
`composer install`
`npm install`
`npm run dev`

Create new database

####2. Setup environtment variables in `.env` files
Make file `.env` in root project
Copy content `.env.example` to `.env`
Configure DB connection in `.env` files

```
DB_CONNECTION=mysql
DB_HOST='change db host'
DB_PORT='change db port'
DB_DATABASE='change db name'
DB_USERNAME='change db username'
DB_PASSWORD='change db password'
```

Run `php artisan key:generate` to generate app key

####3. Run migration
In console
`php artisan migrate`

####4. Run server
In console
`php artisan serve`

Noted: this project is also hosted on https://tes-kasir-alan.biviplant.com/
