# Installation

## Manual

#### Create .env file:
```
cp .env.example .env
```

#### Composer installtion:
```
composer i
```

#### Key generation:
```
php artisan key:generate
php artisan jwt:secret
```

#### Migrate database:
```
php artisan migrate --seed
```

#### Serve:
```
php artisan serve
```

[!] Need to config your mysql database

## Sail

#### Sail up:
```
vendor/bin/sail up
```

#### Migrate database && generate keys:
```
vendor/bin/sail artisan key:generate
vendor/bin/sail artisan jwt:secret
vendor/bin/sail artisan migrate --seed
```



### Access to [localhost](http://localhost)
