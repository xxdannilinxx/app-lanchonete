# app-lanchonete
Aplicativo disponível para multi-plataforma através do quasar fazendo o build com o electron.

### Tecnologias utilizadas
Backend: API RESTful em PHP, framework Code Igniter e framework ORM Doctrine.

Frontend: Quasar e Vue (Vuex).

DB: MySQL (Modelo no Workbench)

## Manutenção
Para ativar o modo "maintence", basta criar o arquivo "manutencao" na raíz do site.

## Produção / Desenvolvimento
Se estiver em modo de desenvolvimento, criar arquivo "dev" na raíz, caso contrário o sistema constatará que está em modo de produção e alguns recursos de desenvolvimento serão perdidos.

## DUMP
Para ativar dump, basta criar o arquivo "dump" na raíz, dentro do arquivo informar o valor numérico de acordo com o dump do Code Igniter:

(1) Mensagens de erros, incluíndo do php / (2) Mensagens de debug / (3) Mensagens informativas / (4) Todas mensagens

ou para desativar, basta remover o arquivo "dump" na raiz.

## Logs
Para acessar o log, dar chmod 777 no arquivo "log.sh" na raíz, ao fazer isso, ele já ativa o dump com todas as mensagens de erros (4).

## Banco de Dados
Criar arquivo "db" na raíz do site com os dados do banco, o modelo do banco está na pasta documentação.
