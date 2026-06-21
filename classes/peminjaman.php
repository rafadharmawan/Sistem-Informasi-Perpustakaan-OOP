<?php
    require_once '../library/database.php';

    class Peminjaman extends Database {
        public function __construct(){
            parent::__construct();
        }

        public function getAll(){
            $query = "SELECT peminjaman.*, member.nama as nama_member, buku.judul as judul_buku FROM peminjaman JOIN member ON peminjaman.id_member = member.id JOIN buku ON peminjaman.id_buku = buku.id ORDER BY peminjaman.id DESC";
            return $this->connection->query($query);
        }

        public function create($idmember, $idbuku, $tanggal){
            $query = "INSERT INTO peminjaman (id_member, id_buku, tanggal_pinjam) VALUES ('".$idmember."','".$idbuku."','".$tanggal."')";
            return $this->connection->query($query);
        }

        public function getBYmember($idmember){
            $query = "SELECT peminjaman.*, buku.judul as judul_buku FROM peminjaman JOIN buku ON peminjaman.id_buku = buku.id WHERE peminjaman.id_member=".$idmember." ORDER BY peminjaman.id DESC";
            return $this->connection->query($query);
        }

        public function getByStatus($status){
            $query = "SELECT peminjaman.*, member.nama as nama_member, buku.judul as judul_buku FROM peminjaman JOIN member ON peminjaman.id_member = member.id JOIN buku ON peminjaman.id_buku = buku.id WHERE peminjaman.status='".$status."' ORDER BY peminjaman.id DESC";
            return $this->connection->query($query);
        }

        public function kembalikan($id){
            $query = "UPDATE peminjaman SET status='dikembalikan' WHERE id=".$id;
            return $this->connection->query($query);
        }
    }
?>