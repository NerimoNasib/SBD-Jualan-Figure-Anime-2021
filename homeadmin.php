<?php
    include_once("config.php");
    
    //Inisialisasi sesi
    session_start();
    
    //Mengecek apakah user telah login, jika tidak akan kembali ke halaman login
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: loginadmin.php");
        exit;
    }

    $listbarang = mysqli_query($link, "SELECT * FROM barang WHERE is_delete=0 ORDER BY id_barang");
    $listpembeli = mysqli_query($link, "SELECT * FROM pembeli WHERE is_delete=0 ORDER BY id_pembeli");
    $listpembayaran = mysqli_query($link, "SELECT pembayaran.id_pembayaran, barang.nama_barang, barang.harga, pembeli.nama, pembeli.rekening, pembayaran.waktu_beli FROM barang INNER JOIN pembayaran ON barang.id_barang=pembayaran.id_pembayaran INNER JOIN pembeli ON pembeli.id_pembeli=pembayaran.id_pembeli WHERE pembayaran.is_delete = 0");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Homepage Admin</title>
        <style>
            h3 {
                text-align: center;
            }
            table {
                margin-left: auto;
                margin-right: auto;
            }
            th {
                padding: 10px 10px 10px 10px;
                text-align: center;
            }
            tr  {
                text-align: center;

            }
            td {
                padding: 10px 10px 10px 10px;
            }
            p {
                text-align: center;
            }
            .Tabel {
                margin-bottom: 10px;
                margin-left: 20px;
                margin-right: 20px;
                border-style: solid;
            }
        </style>
    </head>
    <body>
        <div style="text-align: center">
            <h1>Data Barang dan Pembeli</h1>
        </div>
        
        <div class='Tabel'>
        <h3>Katalog barang</h3>
        <table width='80%' border=1>
        <p>
            <a href="addbarang.php">Tambah Barang</a>
        </p> 
            <tr>
                <th>ID Barang</th> <th>Nama</th> <th>Harga</th> <th>Aksi</th>   
            </tr>

            <?php
                while($item = mysqli_fetch_array($listbarang)) {
                    echo "<tr>"; 
                    echo "<td>".$item['id_barang']."</td>"; 
                    echo "<td>".$item['nama_barang']."</td>"; 
                    echo "<td>".$item['harga']."</td>"; 
                    echo "<td><a href='editbarang.php?id=$item[id_barang]'>Edit</a> 
                    | 
                    <a href='softdeletebarang.php?id=$item[id_barang]'>Soft Delete</a></td></tr>";
                }
            ?>
        </table><br>
        </div>

        <div class='Tabel'>
        <h3>Data Pembeli</h3>
        <table width='80%' border=1>
        <p>
            <a href="addpembeli.php">Tambah Data Pembeli</a>
        </p> 
            <tr>
                <th>ID</th> <th>Nama</th> <th>Rekening</th> <th>Aksi</th> 
            </tr>
        
            <?php
                while($item = mysqli_fetch_array($listpembeli)) {
                    echo "<tr>"; 
                    echo "<td>".$item['id_pembeli']."</td>"; 
                    echo "<td>".$item['nama']."</td>"; 
                    echo "<td>".$item['rekening']."</td>"; 
                    echo "<td><a href='editpembeli.php?id=$item[id_pembeli]'>Edit</a> 
                    | 
                    <a href='softdeletepembeli.php?id=$item[id_pembeli]'>Soft Delete</a></td></tr>"; 
                }
            ?>
        </table><br>
        </div>
        
        <div class='Tabel'>
        <h3>Data Pembayaran</h3>
        <table width='80%' border=1>
        <p>
            <a href="addpembayaran.php">Tambah Data Pembayaran</a>
        </p>
            <tr>
            <th>ID Pembayaran</th> <th>Nama Barang</th> <th>Harga</th> <th>Nama Pembeli</th> <th>Rekening</th> <th>Waktu Beli</th> <th>Aksi</th>
            </tr>
            
            <?php
                while($item = mysqli_fetch_array($listpembayaran)) {
                    echo "<tr>";
                    echo "<td>".$item['id_pembayaran']."</td>";
                    echo "<td>".$item['nama_barang']."</td>";
                    echo "<td>".$item['harga']."</td>";
                    echo "<td>".$item['nama']."</td>";
                    echo "<td>".$item['rekening']."</td>";
                    echo "<td>".$item['waktu_beli']."</td>";
                    echo "<td><a href='editpembayaran.php?id=$item[id_pembayaran]'>Edit</a> 
                    | 
                    <a href='softdeletepembayaran.php?id=$item[id_pembayaran]'>Soft Delete</a></td></tr>";
                } 
            ?>
        </table><br>
        </div>
        
        <div style="text-align: center">
            <b><a href="viewSoftDelete.php">Recycle Bin</a></b>
        </div>

        <p>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out</a>
        </p>
    </body>
</html>