docker compose up -d
docker exec -it sispay_app composer install
docker exec -it sispay_app composer run-script post-root-package-install
docker exec -it sispay_app php artisan migrate
docker exec -it sispay_app php artisan db:seed
docker compose -f "docker-compose.yml"  -p "sispay" stop
echo "Arquivo startup.bat sera removido!"
Del install.bat
