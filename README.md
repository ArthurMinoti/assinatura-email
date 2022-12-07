# Sistema de geração e inserção de assinaturas de email para o Gmail

<br>

## Descrição do Projeto

Projeto desenvolvido para facilitar a inserção de assinaturas no email de novos colaboradores.

Front-end desenvolvido com bootstrap e back-end desenvolvido em php e JavaScript

<br>

## Instalação do Sistema

É preciso ter o php 8.1 ou superior instalado e o Postgres. O servidor interno do php pode ser utilizado, mas para produção eu utilizei um container Docker do Apache

<a href="https://www.php.net/manual/pt_BR/install.php">Instalação php</a>

<a href="https://www.postgresql.org/">Instalação Postgres</a>

<a href="https://hub.docker.com/r/ubuntu/apache2">Instalação Apache</a>

<br>

1. Clonar o repositório:

```console
# git clone https://github.com/ArthurMinoti/assinatura-email.git
```

2. Criar um banco de dados Postgres e trocar as credenciais em controller/connection_bd.php;

3. Criar um banco de dados no Postgres, disponível em banco.sql <a href="https://blog.tecnospeed.com.br/backup-e-restore-postgresql/#:~:text=Veja%20como%20fazer%20o%20restore,%2C%20clique%20em%20'OK'.">Tutorial</a>;

4. Gerar as <a href="https://developers.google.com/identity/gsi/web/guides/get-google-api-clientid">credenciais</a> no Google Cloud Console e substituir no código view/index.php;

5. Criar uma senha para login na tabela 

6. Iniciar o servidor interno do php:

```console
# php -S localhost:80
```


