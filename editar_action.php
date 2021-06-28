<?php

session_start();
require 'config.php';
require 'dao/UsuarioDaoMySql.php';

$conn = new Conexao;
$pdo = $conn->conectar();
$usuarioDao = new UsuarioDaoMySql($pdo);

$id = filter_input(INPUT_POST, 'id');
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);


if($id && $nome && $email){

        $usuario = new Usuario;
        $usuario->setId($id);
        $usuario->setNome($nome);
        $usuario->setEmail($email);

        $usuarioDao->update($usuario);
        header('Location: index.php');


} else {

    $_SESSION['erro'] = '1';
    header('Location: editar.php?id='.$id);
    exit;

}