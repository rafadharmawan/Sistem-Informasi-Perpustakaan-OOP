<?php
    require_once '../library/database.php';

    class Kategori extends Database{
        public function __construct(){
            parent::__construct();
        }

        public function getALL(){
            $query = "SELECT * FROM kategori ORDER BY id DESC";
            return $this->connection->query($query);
        }

        public function getBYid($id){
            $query = "SELECT * FROM kategori WHERE id=".$id;
            $result = $this->connection->query($query);
            return $result->fetch_assoc();
        }

        public function create($nama){
            $query = "INSERT INTO kategori (nama) VALUES ('".$nama."')";
            return $this->connection->query($query);
        }

        public function update($id, $nama){
            $query = "UPDATE kategori SET nama='".$nama."' WHERE id=".$id;
            return $this->connection->query($query);        
        }

        public function delete($id){
            $query = "DELETE FROM kategori WHERE id=".$id;
            return $this->connection->query($query);
        }
    }
?>