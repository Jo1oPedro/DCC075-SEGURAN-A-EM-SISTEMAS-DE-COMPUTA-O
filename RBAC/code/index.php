<?php

use Seguranca\Rbac\Database\Connection;
use Seguranca\Rbac\Http\Request;

require_once __DIR__ . '/vendor/autoload.php';

# Executar o comando composer install
# Executar php -S localhost:8000 -t . index.php

// Realiza a conexão com um banco de dados mysql na porta 3306
$connection = Connection::getConnection();

// Monta a request com dados de get/post/cookies/files/server
$request = Request::getRequest();

// Verifica se é a rota de registro de usuários
/* json de envio é:
'{
    "email": "jpppedreira@gmail.com",
    "password": "123456",
    "role": "teacher" ou "student"
}'
*/
if($request->server['PATH_INFO'] === '/register') {
    //verifica se todos os campos estão presentes
    if(!isset($request->post['email']) || !isset($request->post['password']) || !isset($request->post['role'])) {
        http_response_code(400);
        echo "Os campos: email, password e role são obrigatórios";
        exit;
    }

    //verifica se uma role valida
    if(!in_array($request->post['role'], ['teacher', 'student'])) {
        http_response_code(422);
        echo 'Role invalida: ' . $request->post['role'];
        exit;
    }

    // insere no banco
    $hashedPassword = password_hash($request->post['password'], PASSWORD_DEFAULT);
    $query = 'INSERT INTO users (email, password, role) VALUES (:email, :password, :role)';
    $statement = $connection->prepare($query);
    try {
        $statement->execute(
            [
                'email' => $request->post['email'],
                'password' => $hashedPassword,
                'role' => $request->post['role']
            ]
        );
    } catch (Exception $exception) {
        echo $exception->getMessage();
    }
    exit;
}

//Rota para recuperar dados de um student ou de um teacher baseado no email
if($request->server['PATH_INFO'] === '/getData') {
    // verifica se o email foi enviado
    if(!isset($request->get['email'])) {
        http_response_code(400);
        echo "O campo de email é obrigatório";
    }

    //busca os dados do usuário na tabela
    $query = "SELECT * FROM users WHERE email = :email";
    $statement = $connection->prepare($query);
    try {
        $statement->execute(['email' => $request->get['email']]);
        $user = $statement->fetch();
    } catch (Exception $exception) {
        echo $exception->getMessage();
        exit;
    }

    //Se for um teacher busca todos os dados de teachers do banco
    if($user['role'] == 'teacher') {
        $data = $connection
            ->query('SELECT * FROM teachersData')
            ->fetchAll(PDO::FETCH_ASSOC);

        $data = json_encode($data);
        echo $data;
        exit;
    }

    //Caso não seja um teacher então é um student, então busca todos os dados de students do banco
    $data = $connection
        ->query('SELECT * FROM studentsData')
        ->fetchAll();

    $data = json_encode($data);
    echo $data;
    exit;
}