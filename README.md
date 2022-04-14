# Teste Feegow

Front-end feito utilizando Vue.js
Back-end feito utilizando php puro(sem frameworks) com psr 3 e 4

Link com vídeo com um overview do front funcionando.
<https://youtu.be/bjRqtkr6nM8>

## Como rodar:
## Front-end
- Ter um geranciador de pacote instalado npm ou yarn.

Para executar o front, acesse a pasta front-end e execute o comando no terminal
```sh
yarn serve
```
Após o comando ser executado, o front pode ser acessdo, pela url: http://localhost:8080, dependendo das portas que estejam ocupadas no seu computador, pode ser, que as portas na url mude.

 
os arquivos de configuração do front estão no arquivo front-end/config/index.js

## Back-end
- Ter docker instalado na máquina (Disponível para Linux, Apple e Windows) Link para download: https://www.docker.com/products/docker-desktop


Para executar o back-end, acesse a pasta do (back-end) e execute o comando abaixo através do terminal:
```sh
docker-compose up -d
```

URL DO BACK-END http://localhost:8989

Caso queira acesso o banco de dados, eu deixei um container com o phpmyadmin
url do container com phpmyadmin: http://localhost:8081/
Dados de login do phpmyadmin
```sh
servidor: mysql
Utilizador: root
Palavra-passe: root
banco de dados: api
```

O back-end possui um arquivo com dados sensíveis, que pode ser acessado nesse caminho: back-end/config/setup.php

 
