- docker cp a400wsckk88ogos84woksgog-215942115315:/app/storage/app/public/uploads_backup.zip /data/portal-bntk/storage/app/public/uploads_backup.zip

- docker cp /data/portal-bntk/storage/app/public/uploads_backup.zip a400wsckk88ogos84woksgog-160912018705:/app/storage/app/public/uploads_backup.zip

- php artisan storage:link

- sudo chmod -R 777 storage

- sed -i '/http {/a\    client_max_body_size 128M;' nginx.conf

- nginx -s reload

cat > /assets/php-fpm.conf << 'EOF'
[www]
listen = 127.0.0.1:9000
user = nobody
pm = dynamic
pm.max_children = 50
pm.min_spare_servers = 4
pm.max_spare_servers = 32
pm.start_servers = 18
clear_env = no
catch_workers_output = yes
; === PHP upload limits ===
php_value[upload_max_filesize] = 128M
php_value[post_max_size] = 128M
php_value[memory_limit] = 512M
php_value[max_execution_time] = 300
php_value[max_input_time] = 300
EOF


pkill -o php-fpm
php-fpm -y /assets/php-fpm.conf
nginx -s reload
