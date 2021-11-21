cd php-src
git clone https://github.com/php/php-src php_source
cd php_source
git checkout php-7.1.32
cd ..
docker-compose up -d
cd ../gdb
docker-compose up -d
