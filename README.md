# Drag-and-drop-laravel

Este repositório contém os arquivos de uma aplicação que faz o upload de múltiplos arquivos com drop-and-drag (arrastar e soltar).

Neste projeto utilizei o [Laravel Framework](https://laravel.com/) na versão 8 para o backend, e a biblioteca [dropzone.js](https://www.dropzonejs.com/) para o input de imagens no frontend. No deploy da aplicação utilizei o Heroku. 

Caso não deseje fazer a instalação do projeto em seu ambiente, veja ela em execução abaixo:

[Clique aqui para ver](http://drop-files-laravel.herokuapp.com/)

Seguem abaixo os requisitos e procedimentos para instalação do projeto em ambiente de desenvolvimento, e algumas observações gerais:

## Requisitos de Ambiente

PHP >= 7.3 

MySql >= 5.7

Node >= 14.0

Phpmyadmin (Recomendado para criar e acessar banco de dados de forma visual no navegador)
    
[WampServer](https://www.wampserver.com/en/) (Recomendado pois este faz a instalação do servidor Apache PHP, Mysql, Phpmyadmin)

[Composer](https://getcomposer.org/) 

## Como instalar o projeto 

<ul>
    <li>Clone este repositório, e coloque a pasta do projeto na pasta pública do servidor PHP local. "C:\wamp64\www\*" caso utilizar o WampServer ou "C:\xampp\htdocs\*" caso utilizar o Xamp Server.</li>
    <li>Crie um banco de dados Mysql para o projeto</li>
    <li>Acesse a pasta do projeto através de algum terminal de comandos, e crie um arquivo .env para configurar as variáveis de ambiente, pelo comando: </li>
</ul>

    cp .env.example .env     
<ul>
    <li>Configure as seguintes variáveis do arquivo .env de acordo à seu ambiente, em algum editor de texto: </li>
</ul>

    APP_URL=http://localhost/fut-agenda/public/ (Url completa do projeto em seu ambiente)
    DB_HOST=127.0.0.1 (com o host banco de dados)
    DB_PORT=3306 (com a porta do host do banco de dados)
    DB_DATABASE=desafio (com o nome do banco de dados)
    DB_USERNAME=root (com o nome do usuário com acesso ao banco de dados) 
    DB_PASSWORD= (com a senha do usuário com acesso ao banco de dados) 
 <ul>
    <li>Instale as  dependências do LARAVEL pelo comando: </li>
 </ul> 
 
    composer install    
    
<ul>
    <li>Gere a chave da aplicação pelo comando: </li>
</ul>
    
    php artisan key:generate

<ul>  
    <li>Gere as tabelas do banco de dados executando o comando: </li>
</ul>    
    
    php artisan migrate

<ul>  
    <li>Instale as dependências NPM pelo comando: </li>
</ul>    
    
    npm i --silent

<ul>  
    <li>Faça a compilação dos assets do projeto, pelo comando: </li>
</ul>    
    
    npm run watch

## Observações e Orientações

Antes de tudo, para o usuário começar a usar o sistema, ele precisa cadastrar-se e fazer o login.

<img src="/public/img/register_login.PNG"> 

Ao entrar no sistema, será exibido o menu principal com a tela para fazer os uploads dos arquivos.
 
<img src="/public/img/upload.PNG"> 

Onde é possível incluir novas imagens, exclui-las, e editar a legenda de cada uma.

## Validações esperadas 

Ao selecionar alguma imagem e ela não atenda aos requisitos de upload ( seja por tamanho, ou formato ), o retorno da mensagem é mostrado no input do dropzone:

<img src="/public/assets/validacao.PNG">  