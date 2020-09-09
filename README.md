 # Como rodar o projeto 
 
 ### MySQL
 
 Copie o arquivo ".env.example" e altere seu nome para ".env".
   Em seguida, no arquivo ".env", conclua esta configuração do banco de dados:
 * DB_CONNECTION=mysql
 * DB_HOST=127.0.0.1
 * DB_PORT=3306
 * DB_DATABASE=laravel
 * DB_USERNAME=root
 * DB_PASSWORD=
 
 ### PHP
 ### Habilitar  a extensão
;extension=php_fileinfo para extension=php_fileinfo
no php.ini

 
 ### Executar comandos
 
 ``` bash
 # dentro do diretorio
 # generate laravel APP_KEY
 $ php artisan key:generate

# rodar composer
 $ composer update
 
 # rodar database migration e seed
 $ php artisan migrate:refresh --seed

 # iniciar o servidor
 $ php artisan serve
 
 ```

 
