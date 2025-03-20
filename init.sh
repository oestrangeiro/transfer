#!/bin/bash

# Script de inicialização do servidor embutido do php

PORT=9090;
IP_ADDRESS=xxx.xxx.xx.xx; # Evidentemente troque pelo ip da sua máquina

echo "[*] Inicializando o servidor na porta: "$PORT;

# Essas coisas que vem depois de '-d' são diretivas de inicialização
# Essa duas são para permitir envio de arquivos maiores.
# Por padrão,o php só aceita arquivos de até 2M e possui uma memória
# máxima total de 8M
# Enfim, são coisas que você mesmo pode modificar no arquivo php.ini
# Ou no meu caso, inicializar já assim por linha de comando

php -d post_max_size=1024M -d upload_max_filesize=512M -S $IP_ADDRESS:$PORT -t public/ 
