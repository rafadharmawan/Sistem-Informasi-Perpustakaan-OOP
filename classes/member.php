<?php
    require_once __DIR__.'/../library/database.php';

    class Member extends Database{
        public function __construct(){
            parent::__construct();
        }

        public function getAll(){
            $query = "SELECT * FROM member ORDER BY id DESC";
            return $this->connection->query($query);
        }

        public function getBYid($id){
            $query = "SELECT * FROM member WHERE id=".$id;
            $result = $this->connection->query($query);
            return $result->fetch_assoc();
        }

        public function create($nama, $email, $password){
            $query = "INSERT INTO member (nama, email, password) VALUES ('".$nama."', '".$email."', '".$password."')";
            return $this->connection->query($query);
        }

        public function update($id, $nama, $email){
            $query = "UPDATE member SET nama='".$nama."', email='".$email."' WHERE id=".$id;
            return $this->connection->query($query);
        }

        public function delete($id){
            $query = "DELETE FROM member WHERE id=".$id;
            return $this->connection->query($query);
        }

        public function cekEmail($email){
            $query = "SELECT * FROM member WHERE email='".$email."'";
            $result = $this->connection->query($query);
            return $result->num_rows;
        }

        public function login($email, $password){
            $query = "SELECT * FROM member WHERE email='".$email."' AND password='".$password."'";
            $result = $this->connection->query($query);
            return $result->fetch_assoc();
        }
    }
?>