<?php
    session_start();
    if(!isset($_SESSION['member'])){
        header('location: ../login.php');
    }

    require_once '../classes/buku.php';
    require_once '../classes/kategori.php';

    $buku = new Buku();
    $kategori = new Kategori();

    $idkategori = '';
    if(isset($_GET['filter']) && $_GET['id_kategori'] != ''){
        $idkategori = $_GET['id_kategori'];
        $data = $buku->getBYkategori($idkategori);
    }else{
        $data = $buku->getAll();
    }

    $dataKategori = $kategori->getAll();
?>

<html>
    <?php include '../library/header.php'; ?>
    <body>
        <header class="main-header">
            <div class="main-logo">Perpus <span>Digital</span></div>
                <div>
                    <a href="/perpustakaan/user/index.php">Home</a>
                    <a href="/perpustakaan/user/peminjaman.php">Peminjaman Saya</a>
                    <a href="/perpustakaan/logout.php">Logout</a>
                </div>
        </header>  

        <div class="admin-container">
            <h1>Koleksi Buku</h1>
            <p>Selamat datang, <?= $_SESSION['member']; ?></p>
            <br>

            <form method="GET">
                <select class="input" name="id_kategori">
                    <option value="">-- Semua Kategori --</option>
                    <?php while($kat = $dataKategori->fetch_assoc()){ ?>
                        <option value="<?= $kat['id']; ?>" <?php echo ($idkategori == $kat['id']) ? 'selected' : ''; ?>>
                            <?= $kat['nama']; ?>
                        </option>
                    <?php } ?>
                </select>
                <br><br>
                <button type="submit" class="button" name="filter">Filter</button>
                <a href="index.php"><button type="button" class="button">Reset</button></a>
            </form>

            <br>

            <div class="buku-grid">
                <?php while($row = $data->fetch_assoc()){ ?>
                    <div class="buku-card">
                        <h3><?= $row['judul']; ?></h3>
                        <p><?= $row['pengarang']; ?></p>
                        <p><?= $row['nama_kategori']; ?></p>
                        <p>Stok: <?= $row['stok']; ?></p>
                        <br>
                        <a href="detail_buku.php?id=<?= $row['id']; ?>">Detail</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </body>
</html>