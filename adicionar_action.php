<?php
    session_start();
    require 'config.php';
    require 'dao/UsuarioDaoMySql.php';

    $conn = new Conexao;
    $pdo = $conn->conectar();
    $usuarioDao = new UsuarioDaoMySql($pdo);

    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);


    if($nome && $email){

        if($usuarioDao->findByEmail($email) === false) {
            $novoUsuario = new Usuario;
            $novoUsuario->setNome($nome);
            $novoUsuario->setEmail($email);

            $usuarioDao->add($novoUsuario);
            header('Location: index.php');
            exit;
        } else {

            header('Location: adicionar.php?email_ja_preenchido');
            exit;
        }

        

    } else {

        $_SESSION['erro'] = '1';
        header('Location: adicionar.php?preencha_os_campos');
        exit;

    }