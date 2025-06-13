# Init Development
docker-compose.yml.development nach docker-compose.override.yml kopieren und Parameter anpassen (z.B. Datenbank-Port)
.env.example nach .env kopieren

# Pakete lokal installieren anschließend vscode neu starten
`composer install --ignore-platform-reqs`

# Container starten
docker-compose up -d

# Im Container
# Rechte auf vendor für www-data setzen
docker-compose exec -u root php-fpm chown www-data:www-data /app/vendor
# Pakete installieren
docker-compose exec php-fpm composer install
# Applikation Key erzeugen
docker-compose exec php-fpm php artisan key:generate
# .env laden
docker-compose exec php-fpm php artisan config:cache
# migations-table anlegen
docker-compose exec php-fpm php artisan migrate:install
# migrationen ausführen
docker-compose exec php-fpm php artisan migrate
# datenbank mit beispieldaten füllen
docker-compose exec php-fpm php artisan db:seed
# Benutzer anlegen
docker-compose exec php-fpm php artisan create:user
