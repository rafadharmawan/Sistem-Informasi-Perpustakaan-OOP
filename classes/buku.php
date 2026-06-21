<?php
    require_once '../library/database.php';

    class Buku extends Database {
        public function __construct(){
            parent::__construct();
        }

        public function getAll(){
            $query = "SELECT buku.*, kategori.nama as nama_kategori FROM buku JOIN kategori ON buku.id_kategori = kategori.id ORDER BY buku.id DESC";
            return $this->connection->query($query);
        }

        public function getBYid($id){
            $query = "SELECT buku.*, kategori.nama as nama_kategori FROM buku JOIN kategori ON buku.id_kategori = kategori.id WHERE buku.id=".$id;
            $result = $this->connection->query($query);
            return $result->fetch_assoc();
        }

        public function create($judul, $pengarang, $penerbit, $tahun, $stok, $deskripsi, $idkategori){
            $query = "INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit, stok, deskripsi, id_kategori) VALUES ('".$judul."','".$pengarang."','".$penerbit."','".$tahun."','".$stok."','".$deskripsi."','".$idkategori."')";
            return $this->connection->query($query);
        }

        public function update($id, $judul, $pengarang, $penerbit, $tahun, $stok, $deskripsi, $idkategori){
            $query = "UPDATE buku SET judul='".$judul."', pengarang='".$pengarang."', penerbit='".$penerbit."', tahun_terbit='".$tahun."', stok='".$stok."',deskripsi='".$deskripsi."', id_kategori='".$idkategori."' WHERE id=".$id;
            return $this->connection->query($query);
        }

        public function delete($id){
            $query = "DELETE FROM buku WHERE id=".$id;
            return $this->connection->query($query);
        }

        public function getBYkategori($idkategori){
            $query = "SELECT buku.*, kategori.nama as nama_kategori FROM buku JOIN kategori ON buku.id_kategori = kategori.id WHERE buku.id_kategori=".$idkategori;
            return $this->connection->query($query);
        }

        public function kurangiStok($id){
            $query = "UPDATE buku SET stok = stok - 1 WHERE id=".$id;
            return $this->connection->query($query);
        }

        public function tambahStok($id){
            $query = "UPDATE buku SET stok = stok + 1 WHERE id=".$id;
            return $this->connection->query($query);
        }
    }
?>