<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p> <p align="center"> <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a> </p>
Sistema Escolar - Laravel 11 (PHP 8.3)
Este é um sistema de gerenciamento escolar desenvolvido em Laravel 11 e PHP 8.3, com funcionalidades de cadastro de alunos, turmas, matrículas e geração de relatórios. A aplicação possui três perfis de usuários: Secretaria, Assistente e Cadastro, cada um com permissões específicas.

Requisitos
PHP: 8.3 ou superior
Composer
MySQL ou SQLite (configurado no .env)
Node.js e npm (para gerenciamento de dependências front-end e compilação de assets)
Instalação
Siga as instruções abaixo para rodar o projeto localmente:

1. Clone o Repositório
   git clone https://github.com/Chimarrao/teste-lucas-reolon-laravel-php-sis
2. Instale as Dependências
   Instale as dependências do PHP usando o Composer:

composer install

Instale as dependências do Node.js:

npm install

3. Configure o Arquivo .env
   Duplique o arquivo .env.example e renomeie-o para .env:

cp .env.example .env

Depois, configure o arquivo .env com as credenciais do seu banco de dados (exemplo para MySQL):

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistema_escolar
DB_USERNAME=root
DB_PASSWORD=

4. Gere a Chave da Aplicação
   Execute o comando abaixo para gerar a chave da aplicação:

php artisan key

5. Migre o Banco de Dados
   Para rodar as migrações e criar as tabelas no banco de dados:

php artisan migrate

6. Popule o Banco de Dados
   Para criar os usuários padrão de Secretaria, Assistente e Cadastro, execute o seguinte comando para rodar o seeder:

php artisan db

Isso criará os seguintes usuários com os papéis correspondentes:

Papel: Secretaria
E-mail: secretaria@example.com
Senha: password

Papel: Assistente
E-mail: assistente@example.com
Senha: password

Papel: Cadastro
E-mail: cadastro@example.com
Senha: password

7. Compile os Assets
   Se você estiver utilizando assets como CSS/JS no projeto, compile-os usando o Laravel Mix:

npm run dev

8. Inicie o Servidor de Desenvolvimento
   Para rodar a aplicação localmente:

php artisan serve

Agora você pode acessar a aplicação em http://localhost:8000.

Testes
O projeto possui testes de unidade e de integração, que podem ser executados com os seguintes comandos:

Executar os Testes
php artisan test

Licença
Este projeto está licenciado sob a MIT license.
