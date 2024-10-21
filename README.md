# Sistema de Gestão de Vendas

## Requisitos:
* PHP 7.4;
* Node.js 14 ou superior;
* Laravel 8
* PostgreSQL

## Como iniciar o projeto baixado:
Duplicar o arquivo ".env.example" e renomear para ".env".<br>

No arquivo .env, aplique as seguintes mudanças na parte do banco de dados:

DB_CONNECTION=pgsql<br>
DB_HOST=127.0.0.1<br>
DB_PORT=5432<br>
DB_DATABASE=NOME_DO_BANCO_DE_DADOS<br>
DB_USERNAME=postgres<br>
DB_PASSWORD=SUASENHA

Instalando as dependências do PHP
```
composer install
```

Comando para instalar as dependências do Node.js
```
npm install
```

Comando para gerar a chave do projeto
```
php artisan key:generate
```

Comando para executar as migration
```
php artisan migrate
```

Comando para executar os seeders
```
php artisan db:seed
```

Comando para iniciar o projeto criado com Laravel
```
php artisan serve
```
