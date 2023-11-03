<?php 
    // include database connection file 
    include_once("config.php"); 
    
    // Check if form is submitted for data update, then redirect to homepage after update 
    if(isset($_POST['update'])) { 
        $id = $_POST['id'];
        $nama = $_POST['nama_barang']; 
        $harga=$_POST['harga']; 
        
        // update data 
        $result = mysqli_query($link, "UPDATE barang SET nama_barang='$nama', harga='$harga' WHERE id_barang=$id"); 
        
        // Redirect to homepage to display updated data in list 
        header("Location: homeadmin.php"); }
?>

<?php
    // Display selected minuman based on id 
    // Getting id from url 
    $id = $_GET['id']; 
    
    // Fetch data based on id 
    $result = mysqli_query($link, "SELECT * FROM barang WHERE id_barang=$id");

    while($barang = mysqli_fetch_array($result)) { 
        $id = $barang['id_barang']; 
        $nama = $barang['nama_barang']; 
        $harga = $barang['harga'];

    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Barang</title>
        <style>
            table {
                margin-left: auto;
                margin-right: auto;
            }
            h2 {
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
            td  {
                text-align: center;
                padding: 7px 10px 7px 10px;
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
    <body><a href="homeadmin.php">Home Admin</a> 
    <br/><br/> 
    
    <div class="Tabel">
    <h2>Edit Barang</h2> 
        <form name="update_barang" method="post" action="editbarang.php">
            <table border="0"> 
                <tr>
                    <td>Nama</td> 
                    <td><input type="text" name="nama_barang" value=<?php echo $nama;?>></td>
                </tr> 
                
                <tr>
                    <td>Harga</td> 
                    <td><input type="text" name="harga" value=<?php echo $harga;?>></td> 
                </tr> 

                <tr> 
                    <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td> 
                    <td><input type="submit" name="update" value="Update"></td> 
                </tr> 
            </table> 
        </form>
        </div>
    </body>
</html>