# WibuSaka

A simple app to inform you where to watch anime legally in Indonesia.

WibuSaka uses [Jikan.moe](https://jikan.moe) API to fetch anime datas.

## API References
For API references, refer to our API's [repository](https://github.com/qctfw/wibusaka-api).

## Requirements
- PHP 8.2+
- MySQL 5.7+
- Redis

## Installation and Configuration

1. Copy `.env.example` into `.env` and edit these values

    - Database
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=YOUR_DATABASE_NAME
    DB_USERNAME=YOUR_DATABASE_USERNAME
    DB_PASSWORD=YOUR_DATABASE_PASSWORD
    ```
    - Redis
    ```env
    REDIS_CLIENT=predis
    REDIS_SCHEME=tcp
    REDIS_PATH=YOUR_REDIS_PATH_IF_SCHEME_IS_UNIX
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=YOUR_REDIS_PASSWORD
    REDIS_PORT=6379
    ```

2. Install composer packages
    ```bash
    composer install
    ```

3. Generate Laravel Application Key
    ```bash
    php artisan key:generate
    ```

3. Install npm dependencies.
    ```bash 
    npm install
    ```

4. After the dependencies has been installed, build the Laravel Mix assets
    ```bash
    npm run dev
    ```
    > **Note**
    >
    > Change `dev` into `build` for purging unused styles and scripts.

## Contributing

Contributions are always welcome! Create a pull request **[here](https://github.com/qctfw/wibusaka/pulls)**!

Please make sure to check the existing pull request to avoid duplication.

  