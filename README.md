![Logo SAD](https://i.imgur.com/6bDlrWe.png)

# Sistema SAD
Sistema para o [Serviço de Atenção Domiciliar](http://portalms.saude.gov.br/acoes-e-programas/melhor-em-casa-servico-de-atencao-domiciliar/atencao-domiciliar)

"Com abordagens diferenciadas, esse tipo de serviço está disponível no Sistema Único de Saúde (SUS). De acordo com a necessidade do paciente, esse cuidado em casa pode ser realizado por diferentes equipes. Quando o paciente precisa ser visitado com menos frequência, por exemplo, uma vez por mês, e já está mais estável, este cuidado pode ser realizado pela equipe de Saúde da Família/Atenção Básica de sua referência. Já os casos de maior complexidade são acompanhados pelas equipes multiprofissional de atenção domiciliar (EMAD) e de apoio (EMAP), do Serviços de Atenção Domiciliar (SAD) – Melhor em Casa."

## Introdução:

Este projeto tem em mente a elaboração de um sistema para controle de pacientes e geração de relatórios para o programa "Serviço de Atenção Domiciliar" oferecido pelo SUS (Sistema Único de Saúde). O projeto está sendo desenvolvido em PHP utilizando o framework [Laravel](https://laravel.com/).

## Documento de Requisitos
https://docs.google.com/document/d/1Gb2wkDMzfGuW3ASHd61pZZdqGZjpUvjFp143yvT_Tjg/edit?usp=sharing


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

## Modelagem do Banco de Dados

Utilizar a ferramenta [Visual Paradigm](https://www.visual-paradigm.com/download/community.jsp) para realizar quaisquer mudanças no modelo.

![ERD](https://i.imgur.com/mWLVSmz.jpg)
