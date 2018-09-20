## Manual for test

- git clone https://github.com/dzahkiev/php_mysql_employees.git
- cd php_mysql_employees
- composer install
- скопировать .env.example файл в .env
- изменить настройки БД в файле .env в соответствии со своими значениями
- php artisan migrate --seed
- php artisan serve
- перейти на localhost:8000
