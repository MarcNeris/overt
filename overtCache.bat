cd\
d:
cd Apache24\htdocs\overt

php artisan config:clear
php artisan cache:clear
php artisan route:cache
php artisan route:clear
php artisan view:clear
php artisan config:cache
composer dump-autoload
php artisan queue:work