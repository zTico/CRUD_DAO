<?php
session_start();
require 'config.php';
require 'dao/UsuarioDaoMySql.php';

$conn = new Conexao;
$pdo = $conn->conectar();
$usuarioDao = new UsuarioDaoMySql($pdo);

$usuario = false;
$id = $_GET['id'];

if ($id) {

    $usuario = $usuarioDao->findById($id);
    
} 

if($usuario === false){
    header('Location: index.php');
    exit;
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Formulário</title>
  </head>
  <body>

    <div style="width: 600px; margin: 0px auto; margin-top: 60px">
        <form method="POST" action="editar_action.php">

            <input type="hidden" name="id" value="<?= $usuario->getId(); ?>"/>

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" value="<?= $usuario->getNome();?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" aria-describedby="emailHelp" name="email" value="<?= $usuario->getEmail(); ?>">
                <div class="form-text">ex: teste123@gmail.com</div>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>