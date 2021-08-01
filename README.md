<div style="text-align:center">

<h1>Currency Converter Test</h1>

![](https://img.shields.io/badge/type-probation%20work-green) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;![](https://img.shields.io/badge/status-active-green)


</div>

## Overview

The Currency Convert Test is a Laravel based application, which was created
as a probation work, to demonstrate my current knowledge about Laravel, PHP, Docker
system architecture planning based on business requirements.

![](./imgs/output.gif)

## Tested on
* Ubuntu 20.04.2.0 (Minimal install)
### Ubuntu requirements

1. Install docker: https://docs.docker.com/engine/install/ubuntu/
2. Install docker-compose: `sudo apt install docker-compose`
3. Install PHP >= 8.0: https://linuxize.com/post/how-to-install-php-8-on-ubuntu-20-04/
4. Install other PHP extensions: `sudo apt install php8.0-mbstring php8.0-dom php8.0-mcrypt php8.0-cli`
5. Install Composer: `https://getcomposer.org/download/`
6. Install other tools: `sudo apt install make vim `

## Requirements

### Tools and development environment
* Any type of linux distribution
* Composer (>= 2.x)
* Docker Engine (>= 2.0)
* Docker-Compose (>= 1.25 )

### Software
* Alpine Linux
* NGINX (>= 1.x)
* PHP (>= 8.0)
* Laravel (>= 8.0)

### Other
* Could be found in `composer.json`

## Running Tests

![](./imgs/5iaiw1.jpg)

Run:
`php artisan test`

## Optional configuration

You can switch orders and change currencies in the following file:
```config/currencyapis.php```

You should keep the following format:

```php
return [
    'api_classes' => [
        FreeCurrencyConverterApiComService::class,
        ExchangeRatesApiIoService::class
    ],
    'currencies' => [
        "EUR",
        "USD",
        "HUF",
        "GBP"
    ]
];
```

You can only choose from these two classes, and you can comment out if you wish.
The API-s are executed in the given order that you can see here.

You can set any currencies that are currently supported by the configured API's.

### failover testing

If you want to test failover, you can set the first API in the .env file to `http://localhost`:
example:
```dotenv
FREE_CURRENCY_CONVERTER_API_URI="http://localhost"
EXCHANGE_RATES_API_URI="[...]"
```

## Installation instructions

### 1. Download/clone the files from here
```shell
git clone https://github.com/sosmarton/currency-converter-test
```
### 2. Copy the `.env` file to the root of the project
(The file is sent via email)

### 3. Install composer dependencies and copy src files to src directory
```shell
make pre-install
```

### 4. Configure proper permissions for the `src` directory

It is a requirement for Alpine Linux to work properly.
The 82 UID/GUID is the Nginx users UID/GUID for Alpine linux.

(It was separated from the Makefile because it runs "sensitive" commands on the Host OS)

```shell
sudo chmod -R 755 ./src/*
sudo chown -R 82:82 ./src/* 
```

### 5. Enter `[project root]/docker` directory and setup the containers
```shell
cd docker
make install
```

### 6. Visit site
Visit and see frontend at `http://localhost:8080`.

## Specifications

### Infrastructure overview

![](./imgs/architecture.png)

## Useful Links

* [OpenAPI Speciifcation](./docs/specifications/api-specification.yml)
  * ```I fixed the OpenAPI specification, because there were some typos.```
* [Software Business Requirements](./docs/specifications/software-requirements.md)
