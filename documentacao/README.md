# Configuração

# BANCO DE DADOS
Criar arquivo "db" na raíz do site, o modelo do banco está na pasta documentação.

# PRODUCÃO / DEESNVOLVIMENTO
Se estiver em modo de desenvolvimento, criar arquivo "dev" na raíz, caso contrário o sistema constatará que está em modo de produção.

# DUMP
Para ativar dump, basta criar o arquivo "dump" na raíz, dentro do arquivo informar o valor numérico:

1 = Mensagens de erros, incluíndo do php
2 = Mensagens de debug
3 = Mensagens informativas
4 = Todas mensagens

ou para desativar, basta remover o arquivo "dump" na raiz.

* acessível na pasta backend/application/logs através do comando "tail -f".

# LOG
para acessar o log, dar permissão 777 no arquivo "log.sh" na raíz, ao fazer isso, ele já ativa o dump com todas as mensagens de erros (4).