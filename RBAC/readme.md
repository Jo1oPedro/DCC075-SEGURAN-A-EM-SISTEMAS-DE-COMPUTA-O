Nome: João Pedro Ferreira Pedreira
Matricula: 202076009

Para executar o projeto:<br>
1°: execute na raiz: docker compose up --build -d<br>
2°: execute na raiz: docker compose exec -it rbac bash<br>
3°: execute: php database.php<br>
4°: realize uma requisição post para a rota /register com os campos email, password e role<br>
5°: realize uma requisição para a rota /getData com o parâmetro de rota email: localhost:8000/getData?email=jpppedreira@gmail.com