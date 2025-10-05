# 1. Mulai server database (MariaDB)
sudo systemctl start mariadb

# 2. Mulai server web Apache (hanya untuk memastikan semua ekstensi PHP termuat dengan benar)
sudo systemctl start apache2

# 3. Mulai Codeigniter 4
php spark serve