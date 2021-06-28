<?php

    require 'config.php';
    require 'dao/UsuarioDaoMySql.php';

    $conn = new Conexao;
    $pdo = $conn->conectar();
    $usuarioDao = new UsuarioDaoMySql($pdo);

    $id = filter_input(INPUT_GET, 'id');
        
    if($id){
        $usuarioDao->delete($id);
    }


        header('Location: index.php?deletado_com_sucesso');
        exit;
 