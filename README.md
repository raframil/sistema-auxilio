
![Logo SAD](https://i.imgur.com/6bDlrWe.png)

# Sistema SAD
Sistema para o [Serviço de Atenção Domiciliar](http://portalms.saude.gov.br/acoes-e-programas/melhor-em-casa-servico-de-atencao-domiciliar/atencao-domiciliar)

"Com abordagens diferenciadas, esse tipo de serviço está disponível no Sistema Único de Saúde (SUS). De acordo com a necessidade do paciente, esse cuidado em casa pode ser realizado por diferentes equipes. Quando o paciente precisa ser visitado com menos frequência, por exemplo, uma vez por mês, e já está mais estável, este cuidado pode ser realizado pela equipe de Saúde da Família/Atenção Básica de sua referência. Já os casos de maior complexidade são acompanhados pelas equipes multiprofissional de atenção domiciliar (EMAD) e de apoio (EMAP), do Serviços de Atenção Domiciliar (SAD) – Melhor em Casa."

## Introdução:

Este projeto tem em mente a elaboração de um sistema para controle de pacientes e geração de relatórios para o programa "Serviço de Atenção Domiciliar" oferecido pelo SUS (Sistema Único de Saúde). O projeto está sendo desenvolvido em PHP utilizando o framework [Laravel](https://laravel.com/).

## Documento de Requisitos
https://docs.google.com/document/d/1Gb2wkDMzfGuW3ASHd61pZZdqGZjpUvjFp143yvT_Tjg/edit?usp=sharing

## Tabela de Estimativa de Esforço  
https://docs.google.com/spreadsheets/d/1w5y1mN_W8CLXcGuzIpXCiCrntfkFdaF02LpfKHyG5Vk/edit?usp=sharing

## Matriz de Rastreabilidade Bidirecional (MRB)
https://drive.google.com/file/d/19jaY5XBBi1jSXIEWKYjzUy3a24F6ky11/view?usp=sharing

## Cronograma
Cronograma elaborado utilizando o MS Project e utilizando a tabela de estimativa de esforço como base para atribuição de esforço/tarefas. Última atualização em 13/11
https://www.scribd.com/document/392890649/Cronograma-ES1

## Dependências:
- [Requerimentos do Laravel](https://laravel.com/docs/5.7#server-requirements)
- [MySQL](https://www.mysql.com/)

Ou utilizar o Docker do projeto, já configurado com PHP(Caddy), MySQL, PHPMyAdmin.
- [Docker](https://docs.docker.com/get-started/)
- [Docker Compose](https://docs.docker.com/compose/)

## Como instalar

### Windows utilizando o Docker:
Execute o comando pelo cmd:

>./run.bat

### Linux utilizando o Docker:
Execute o comando pelo terminal:

>chmod +x run.sh | ./run.sh

### Linux por linha de comando

#### Preparação

##### Atualize o apt
>sudo apt-get update && apt-get upgrade

##### Instale as dependências
>sudo apt-get install composer apache2 libapache2-mod-php mysql-server php php-mbstring php-pear php-dev php-zip php-curl php-gd php-mysql php-mcrypt php-xml libapache2-mod-php

##### Instale o laravel
>composer global require laravel/installer

##### Abra o diretório referente ao seu localhost: (ex. /var/www ou /opt/lampp/htdocs)
>cd /var/www

##### Clone o repositório
>git clone https://github.com/raframil/sistema-auxilio.git

##### Abra o diretório clonado e extraia a pasta laravel
>cd sistema-auxilio
>sudo mv laravel ..
>cd ..
>rm -rf sistema-auxilio

#### Configurando o banco de dados

##### Execute o mysql shell
>mysql -u root -p

Será solicitada a senha, digite-a.

##### Crie o banco de dados (Ex. sad)
>mysql> create database sad;

##### Saia do shell
>mysql> exit

##### Baixe o arquivo .sql do banco de dados no link:
https://www.dropbox.com/sh/yturfrmyczao2oa/AACcQMpIJBnQ0NCypAAtlZBla?dl=0

##### Abra a pasta onde o arquivo foi baixado
>cd ~/Downloads

##### Importe os dados do arquivo para o banco de dados
>mysql -u root -p sad < sad.sql

#### Instalação

##### Abra o diretório do laravel: (ex. /var/www/laravel)
>cd /var/www/laravel

##### Instale o composer
>composer install

##### Crie um novo arquivo .env
>cp .env.example .env

##### Gere uma chave de encriptação
>php artisan key:generate

##### Abra o arquivo .env
>sudo gedit .env

##### Localize e modifique as seguintes linhas

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=[NOME-DO-BD]
    DB_USERNAME=[USUÁRIO-DO-BD]
    DB_PASSWORD=[SENHA-DO-BD]

#### Inicialize o servidor
>php artisan serve

## Modelagem do Banco de Dados

Utilizar a ferramenta [Visual Paradigm](https://www.visual-paradigm.com/download/community.jsp) para realizar quaisquer mudanças no modelo.

Versão 0.1:
https://i.imgur.com/mWLVSmz.jpg

Versão 0.2 (Att em 14/11):
![ERD](https://i.imgur.com/ooZu9lW.png)

-- Download do Banco: https://www.dropbox.com/sh/yturfrmyczao2oa/AACcQMpIJBnQ0NCypAAtlZBla?dl=0
