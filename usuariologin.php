<?php
//Receber dados do formulário 
$usuario = $_POST["usuario"];
$senha = $_POST["senha"];
try {
    //conectar o banco de dados dentro do try
    $conexao = new PDO('mysql:host=localhost;dbname=loginphp', 'root', '');
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //preparar a consulta usando Placeholder
    $query = "SELECT * FROM usuario WHERE nomeUsuario = :usuario";
    $stmt = $conexao->prepare($query);

    //Associar o parametro ao valor da variável para evitar o SQL Injection
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);

    //Executar a consulta
    $stmt->execute();

    //obter o resultado 
    $logado = $stmt->fetch(PDO::FETCH_ASSOC);

    //verificar se o usuário foi encontrado e senha está correta
    if ($logado && password_verify($senha, $logado['senhaUsuario'])) {
        session_start();
        $_SESSION['usuario_logado'] = $logado['id'];
        header('Location: painel.php');
    }else {
        header('Location: usuarioerro.php');
    }
} catch (PDOException $e) {
    echo "Erro na conexão ou na execução da consulta" . $e->getMessage();

}
die();


?>