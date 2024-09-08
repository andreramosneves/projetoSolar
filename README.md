## Instruções

Baixar a a aplicação e executar o:
docker-compose up --build -d
1) docker-compose up -d


Ao executar uma vez, descomentar a linha para subir a aplicação mais rapido.
2)    command: >
      sh -c "php artisan migrate --force && php artisan config:clear && php artisan optimize:clear && php-fpm"      

