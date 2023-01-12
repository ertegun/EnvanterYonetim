#Sorunlar
docker da composer install sorunu
docker da yetki sorunu

Çalıştırılacak komutlar

composer update
yetkiler ayarlanacak

php artisan optimize:clear
composer update

chown -R www-data:www-data /var/www
chmod -R 755 /var/www/storage

sudo chown -R www-data:www-data /path/to/your/project/vendor
sudo chown -R www-data:www-data /path/to/your/project/storage

composer install
chmod 777 storage/
php artisan key:generate
