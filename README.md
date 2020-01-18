# Tenders List Backend
### Installation

Modify .env settings if needed
```sh
$ git clone https://github.com/gcilinskas/tender.git .
$ cp .env.test.dist .env
$ scripts/start-dev.sh
$ scripts/backend.sh
$ composer install
$ sf doctrine:migrations:migrate
$ sf doctrine:fixtures:load
```
