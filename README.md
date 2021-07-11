# WibuList

A simple app to inform you where to watch anime legally in Indonesia.

## Installation 

> This app requires Redis for caching purposes.

Copy `.env.example` into `.env` and edit these values.

```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=YOUR_DATABASE_NAME
    DB_USERNAME=YOUR_DATABASE_USERNAME
    DB_PASSWORD=YOUR_DATABASE_PASSWORD
```

Install composer packages.

```bash
    composer install
```

Install npm dependencies.

```bash 
    npm install
```

After the dependencies has been installed, build the Laravel Mix assets.

```bash
    npm run dev
```

**Note:** If you want to build the minified version, change `dev` into `prod` instead.

## Contributing

Contributions are always welcome! Create a pull request **[here](https://github.com/qctfw/wibulist/pulls)**!

Please make sure to check the existing pull request to avoid duplication.

  