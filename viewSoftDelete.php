<?php
    include_once("config.php");

//Inisialisasi sesi
    session_start();
    
    //Mengecek apakah user telah login, jika tidak akan kembali ke halaman login
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: loginadmin.php");
        exit;
    }

    $barang = mysqli_query($link, "SELECT * FROM barang WHERE is_delete=1 ORDER BY id_barang");
    $pembeli = mysqli_query($link, "SELECT * FROM pembeli WHERE is_delete=1 ORDER BY id_pembeli");
    $pembayaran = mysqli_query($link, "SELECT pembayaran.id_pembayaran, barang.nama_barang, barang.harga, pembeli.nama, pembeli.rekening, pembayaran.waktu_beli FROM barang INNER JOIN pembayaran ON barang.id_barang=pembayaran.id_pembayaran INNER JOIN pembeli ON pembeli.id_pembeli=pembayaran.id_pembeli WHERE pembayaran.is_delete = 1");
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
            <h1>Recycle Bin</h1>
        </div>
        
        <div class='Tabel'>
        <h3>Katalog Barang</h3>
        <table width='80%' border=1>
            <tr>
                <th>ID Barang</th> <th>Nama</th> <th>Harga</th> <th>Aksi</th>   
            </tr>

            <?php
                while($item = mysqli_fetch_array($barang)) {
                    echo "<tr>"; 
                    echo "<td>".$item['id_barang']."</td>"; 
                    echo "<td>".$item['nama_barang']."</td>"; 
                    echo "<td>".$item['harga']."</td>"; 
                    echo "<td><a href='restorebarang.php?id=$item[id_barang]'>Restore</a></td></tr>";
                }
            ?>
        </table><br>
        </div>

        <div class='Tabel'>
        <h3>Katalog Pembeli</h3>
        <table width='80%' border=1>
            <tr>
                <th>ID Pembeli</th> <th>Nama</th> <th>Rekening</th> <th>Aksi</th> 
            </tr>
        
            <?php
                while($item = mysqli_fetch_array($pembeli)) {
                    echo "<tr>"; 
                    echo "<td>".$item['id_pembeli']."</td>"; 
                    echo "<td>".$item['nama']."</td>"; 
                    echo "<td>".$item['rekening']."</td>"; 
                    echo "<td><a href='restorepembeli.php?id=$item[id_pembayaran]'>Restore</a></td></tr>"; 
                }
            ?>
        </table><br>
        </div>
        
        <div class='Tabel'>
        <h3>Pembayaran</h3>
        <table width='80%' border=1>
            <tr>
                <th>ID Pembayaran</th> <th>Nama Barang</th> <th>Harga</th> <th>Nama</th> <th>Rekening</th> <th>Waktu Beli</th> <th>Aksi</th>
            </tr>
            
            <?php
                while($item = mysqli_fetch_array($pembayaran)) {
                    echo "<tr>";
                    echo "<td>".$item['id_pembayaran']."</td>";
                    echo "<td>".$item['nama_barang']."</td>";
                    echo "<td>".$item['harga']."</td>";
                    echo "<td>".$item['nama']."</td>";
                    echo "<td>".$item['rekening']."</td>";
                    echo "<td>".$item['waktu_beli']."</td>";
                    echo "<td><a href='restorepembayaran.php?id=$item[id_pembayaran]'>Restore</a> 
                    | 
                    <a href='deletepembayaran.php?id=$item[id_pembayaran]'>Delete</a></td></tr>";
                } 
            ?>
        </table><br>
        </div>
        
        <div style="text-align: center">
            <b><a href="homeadmin.php">Home Admin</a></b>
        </div>
    </body>
</html>