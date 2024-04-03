Para executar o projeto:<br>
1°: instale o php 8+<br>
2°: instale o composer: https://getcomposer.org/<br>
3°: execute: composer install na raiz<br>
4°: crie um banco de dados mysql com nome: test, user: root e senha: ""<br>
5°: crie a tabela users com campos email, password e role<br>
6°: crie a tabela teachersdata com campos name e email<br>
7°: crie a tabela studentsdata com campos name e email<br>
8°: rode o servidor executando php -S localhost:8000 -t . index.php
9°: realize uma requisição post para a rota /register com os campos email, password e role
10°: realize uma requisição para a rota /getData com os parametro de rota email: localhost:8000/getData?email=jpppedreira@gmail.com
 