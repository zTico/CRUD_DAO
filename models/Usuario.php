<?php


    class Usuario {
        private $id;
        private $nome;
        private $email;

        public function setId($id){
            $this->id = trim($id);
        }

        public function getId(){
            return $this->id;
        }

        public function setNome($nome){
            $this->nome = ucwords(trim($nome));
        }

        public function getNome(){
            return $this->nome;
        }

        public function setEmail($email){
            $this->email = strtolower(trim($email));
        }

        public function getEmail(){
            return $this->email;
        }

    }

    interface UsuarioDao {
        public function add(Usuario $usuario);
        public function findAll();
        public function findByEmail($email);
        public function findById($id);
        public function update(Usuario $usuario);
        public function delete($id);

    }