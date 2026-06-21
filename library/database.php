<?php
    class Database {
        
        protected $connection;

        public function __construct(){
            $this->connection = new mysqli('localhost:3306','root','','perpustakaan');
        }

        public function getConnection(){
            return $this->connection;
        }

    }
?>