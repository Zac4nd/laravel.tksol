# TKSOL legacy – Docker development / recovery

Recovered application: Laravel **5.5.50** (PHP legacy). Original SQL dumps: MariaDB **10.3**.

**Warning:** PHP 7.4, MariaDB 10.3, and Laravel 5.5 are end-of-life. This environment is for **isolated recovery/testing only**, not for public production deployment. No application migration to PHP 8.4 has yet been performed.

## Contents
- `app/`: Laravel production snapshot, with restored Composer manifests. `vendor/` ignored but copied locally for offline recovery.
- `docker/`: PHP-FPM and Nginx configuration.
- `data/storage/`: recovered application files (not tracked).
- `data/mariadb/`: persistent DB (not tracked).
- Original dumps remain under `/home/andrea/Downloads/DumpTeikos`; not stored in Git.

## Run (local only)
```sh
docker compose build
docker compose up -d
docker compose ps
docker compose logs --tail=100 app nginx db
```
Web: http://127.0.0.1:8088 (loopback only).

Import **test** database into a freshly initialized DB (large dump; may take time):
```sh
docker compose exec -T db sh -c 'exec mysql -uroot -p"$MYSQL_ROOT_PASSWORD" "$MYSQL_DATABASE"' < /home/andrea/Downloads/DumpTeikos/database-test.sql
```
The SQL dump contains statements requiring elevated privileges. The restore therefore uses the DB container administrator, only for import.

To load **production** data (contains sensitive/personal data), substitute `database-production.sql` and use only a secured authorized environment.

The database is *not* automatically overwritten by `up`. Restore into a fresh data directory only after taking a backup.

## Diagnostics
```sh
docker compose exec app php -v
docker compose exec app php artisan --version
docker compose exec app php artisan config:clear
docker compose config --quiet
```

Keep this stack restricted to localhost/VPN. Review any integrations, credentials and external calls before use. **SuiteCRM source is not included** in this dump; deploy separately once supplied. Upgrade Laravel and dependencies before moving to PHP 8.4.
