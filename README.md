## OpenMBO

### Introduction

The project involves the creation of a web application in PHP/Javascript technology using the Laravel 11 framework.
The application is designed to support employee appraisal processes and to this end it is optimized for the possibility of introducing a management model that is compatible with both Management By Objectives (MBO) and Objective Key Results (OKR) methodologies. The platform makes it possible to combine these methodologies, use them separately and freely develop your own model. The application is tailored to the needs of an extended organizational structure of a small/medium enterprise.

### Production

OpenMBO is currently in production. Stable version ETA is December 2025.

### Licensing

The Software is free for commercial use and restricted for modifing and altering. For more information see the [License Agreement](LICENSE.md).

### Installation

Firstly, after cloning the repo, install composer dependencies. For that You need to have composer v2 installed on Your machine.

```
composer install
```

Then, copy `.env.example` in order to create `.env` configuration file. Setup configuration to suit your needs, especially fill DB connection details. After that, set your unique artisan key:

```
php artisan key:generate
```

Once You have your secret key injected in Your configuration, proceed with migration (make sure your database configuration details are correct), seed basic application data and clear all cache.

```
php artisan migrate --seed
php artisan optimize:clear
```

Lastly, enable your storage by:

```
php artisan storage:link
```

**Warning:** Application is still in production, so make sure your `.env` file contains following instructions:

```
APP_ENV=local   // or development
APP_DEBUG=true
SESSION_ENCRYPTION=false
SESSION_SECURE_COOKIE=false
```

At this moment application is available only with `pl` language.

See demo here: https://openmbo.damianulan.me

Any question You can submit to **damian.ulan@protonmail.com**.

_Enjoy._
