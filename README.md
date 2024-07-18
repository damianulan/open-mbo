## About OpenMBO

### Installation
Firstly, after cloning the repo, install composer dependencies. For that You need to have composer v2 installed on Your machine.
```
> composer install
```
Then, copy `.env.example` in order to create `.env` configuration file. Setup configuration to suit your needs, especially fill DB connection details. After that, set your unique artisan key: 
```
> php artisan key:generate
```
Once You have your secret key injected in Your configuration, proceed with migration (make sure your database configuration details are correct), seed basic application data and clear all cache.
```
> php artisan migrate --seed
> php artisan optimize:clear
```
**Warning:** Application is still in production, so make sure your `.env` file contains following instructions:
```
APP_ENV=local   // or 'development'
APP_DEBUG=true
SESSION_ENCRYPTION=false
SESSION_SECURE_COOKIE=false
```
At this moment application is available only with `pl` language. 

Any question You can submit to **damian.ulan@protonmail.com**.


*Enjoy.*
