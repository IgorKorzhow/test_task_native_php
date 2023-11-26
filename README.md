После скачивания этого репозитория тебе нужно:
- добавить в etc/hosts следующую информацию
  `127.0.0.1       start-docker.test`
- скопирывать `.env.exaple` и на сонове его создать `.env`
- затем зайти в папку docker и на основе `.env.example` создадим свой `.env` файл
- напишем `docker compose up -d`
- зайти в контейнер app и выполнить `composer install`
- выполнить бд скрипт путь `docker/mysql/scripts/createTables.sql`
## Ваш сайт доступен для использования
