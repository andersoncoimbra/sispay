docker compose up -d
docker exec -it sispay_app php artisan migrate
docker exec -it sispay_app php artisan db:seed
echo "Arquivo startup.bat sera removido!"
Del startup.bat
