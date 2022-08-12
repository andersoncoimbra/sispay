docker compose up -d
winpty docker exec sispay_app composer install
winpty docker exec sispay_app composer run-script post-root-package-install
winpty docker exec sispay_app php artisan migrate
winpty docker exec sispay_app php artisan db:seed
docker compose -f "docker-compose.yml"  -p "sispay" stop
echo "Arquivo startup.sh sera removido!"
rm startup.sh
