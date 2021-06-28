<?php

    require_once 'models/Usuario.php';

    class UsuarioDaoMySql implements UsuarioDao {

        private $pdo;

        public function __construct(PDO $driver){
            $this->pdo = $driver;
        }
        
        public function add(Usuario $usuario){
            $sql = $this->pdo->prepare("INSERT INTO usuario (nome, email) VALUES (:nome, :email)");
            $sql->bindValue(':nome', $usuario->getNome());
            $sql->bindValue(':email', $usuario->getEmail());
            $sql->execute();

            $usuario->setId( $this->pdo->lastInsertId() );
            return $usuario;

        }

        public function findAll(){
            $array = [];

            $sql = $this->pdo->query("SELECT * FROM usuario");
            if ($sql->rowCount() > 0) {
                $data = $sql->fetchAll(PDO::FETCH_ASSOC);

                foreach ($data as $value) {
                    $u = new Usuario;
                    $u->setId($value['id']);
                    $u->setNome($value['nome']);
                    $u->setEmail($value['email']);
                    $array[] = $u;
                
                }
            } 
            return $array;   
        }

        public function findByEmail($email){
            $sql = $this->pdo->prepare("SELECT * FROM usuario WHERE email = :email");
            $sql->bindValue(':email', $email);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $data = $sql->fetch();
                $u = new Usuario;
                $u->setId($data['id']);
                $u->setNome($data['nome']);
                $u->setEmail($data['email']);

                return $u;
            } else {
                return false;
            }
            
            
           
        }

        public function findById($id){
            $sql = $this->pdo->prepare("SELECT * FROM usuario WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            if($sql->rowCount() > 0) {
                $data = $sql->fetch();
                $u = new Usuario;
                $u->setId($data['id']);
                $u->setNome($data['nome']);
                $u->setEmail($data['email']);

                return $u;
            } else {
                return false;
            }
        }

        public function update(Usuario $usuario){

            $sql = $this->pdo->prepare("UPDATE usuario SET nome = :nome, email = :email WHERE id = :id");
            $sql->bindValue(':nome', $usuario->getNome());
            $sql->bindValue(':email', $usuario->getEmail());
            $sql->bindValue(':id', $usuario->getId());
            $sql->execute();

            return true;
        }
        
        public function delete($id){

            $sql = $this->pdo->prepare("DELETE FROM usuario WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
         
        }

    }
