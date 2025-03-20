# transfer
Um sistema web que facilita o rápido envio de arquivos do meu celular para o meu pc, uma vez que (infelizmente) minha máquina não possui bluetooth

## Como usar?:
1) Caso esteja usando linux, conceda as permissões ao arquivo <code>ini.sh</code> com <code>sudo chmod +x ini.sh</code><br>
2) Edite as variáveis:<br>
<code>$PORT=9090</code> para uma porta da sua preferência.<br>
<code>$IP_ADDRESS=xxx.xxx.x.x</code> para o ip da sua máquina.<br>
3) Agora é só subir o servidor na rede com <code>./ini.sh</code><br>

## Como acessar o servidor?:

1) No seu celular, abra o navegador e digite o_ip_da_sua_máquina:a_porta_que_você_escolheu<br>
Por exemplo, se eu salvei no meu <code>ini.sh</code> <code>$IP_ADDRESS</code> como <code>$IP_ADDRESS=192.168.12.12</code> e <code>$PORT</code> como <code>$PORT=9999</code><br>
2) Basta eu acessar o navegador do meu celular e digitar: <code>192.168.12.12:9999</code> e apertar <kbd>Enter</kbd><br>
Pronto, agora você é capaz de visualizar o formulário de upload.

### Aonde ficam os arquivos?:

Os arquivos ficam, por padrão, na pasta 'uploaded_files/' e os logs contendo o ip do cliente, o nome do arquivo e a data de envio ficam, por padrão, nas pasta 'logs/'

## Importante:

O servidor embutido do PHP não possui HTTPS, apenas HTTP, ou seja, no momento que você sobe o servidor na sua máquina e acessa ele na sua rede via outra máquina (como seu celular, por exemplo), você fica exposto a sniffers ou até mesmo a um ataque MITM.<br>
Por ser uma ferramenta de uso pontual meu, recomendo que após o envio dos arquivos para a sua máquina, encerre o servidor com <kbd>CTRL + C</kbd>
