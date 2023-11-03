<?php
    include_once("config.php");

    //Inisialisasi sesi
    session_start();
    
    //Mengecek apakah user telah login, jika tidak akan kembali ke halaman login
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }

    if(isset($_GET['search'])){
        $search = $_GET['search'];
        $listbarang = mysqli_query($link, "SELECT nama_barang, harga FROM barang WHERE is_delete=0 AND nama_barang LIKE '%".$search."%'");
    } else {
        $listbarang = mysqli_query($link, "SELECT nama_barang, harga FROM barang WHERE is_delete=0");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ 
            font: 14px sans-serif; 
            text-align: center; 
            background-color: rgb(233, 228, 201);
            background-image: url("https://i.kym-cdn.com/photos/images/original/001/135/086/364.jpg");
            height: 100%; 
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        h1 {
            font: 40px helvetica; 
            margin-left: 10px;
            margin-right: 10px;
            color: white;
            text-shadow:
            -1px -1px 0 #000,
            1px -1px 0 #000,
            -1px 1px 0 #000,
             1px 1px 0 #000;  
        }
        h3 {
            text-align: center;
            color: rgb(74, 71, 53);
            font-weight: bold;
        }
        table {
            margin-left: auto;
            margin-right: auto;
            border-color: rgb(74, 71, 53);
        }
        th {
            padding: 10px 10px 10px 10px;
            text-align: center;
            font-weight: bold;
            font-size: 17px;
            background-color: rgb(48, 46, 34);
            color: rgb(199, 99, 136);
        }
        tr  {
            text-align: center;
            color: rgb(74, 71, 53);
        }
        td {
            text-align: left;
            padding: 10px 10px 10px 10px;
            color: rgb(74, 71, 53);
        }
        p {
            text-align: center;
        }
        .Tabel {
            padding: 10px 10px 10px 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 20px;
            margin-right: 20px;
            border-radius: 20px;
            background-color: rgb(255, 233, 227);
            border-color: rgb(74, 71, 53);
            opacity:0.9;
            filter:alpha(opacity=90);
        }
        .TabelSearch {
            width: 35%;
            padding: 5px 5px 5px 5px;
            margin-top: 10px;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: auto;
            border-radius: 20px;
            background-color: rgb(227, 145, 141);
            border-color: rgb(74, 71, 53);
            opacity:0.9;
            filter:alpha(opacity=90);
        }
        .buttonSearch {
            background-color: rgb(74, 71, 53);
            color: rgb(255, 250, 227);
            border-color: rgb(74, 71, 53);
            border-radius: 3px;
        }
        .searchLabel {
            font: 20px helvetica; 
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1 class="my-5">Halo, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>! Selamat Datang di Bakul Figur</h1>

    <div class="TabelSearch">
    <form action="home.php" method="GET" name="form1"> 
        <table width="50%" border="0"> 
            <tr>
                <td class="searchLabel">Cari barang:</td>
                <td><input type="text" name="search"></td> 
            </tr>
            <td/><td><input class="buttonSearch" type="submit" value="Search" /></td>
        </table> 
    </form>
    </div>

    <div class="Tabel">
    <h3>Katalog Barang</h3>
        <table width='80%' border=2>
            <tr class="Search">
                <th>Nama Barang</th> <th>Harga</th>
            </tr>
            
            <?php
                while($item = mysqli_fetch_array($listbarang)) {
                    echo "<tr>";
                    echo "<td>".$item['nama_barang']."</td>";
                    echo "<td>".$item['harga']."</td>";
                } 
            ?>
        </table><br>
    </div>
    
    <p>
        <a href="logout.php" class="btn btn-danger ml-3">Keluar</a>
    </p>
</body>
</html>

<?php
    
?>