<?php 
    // include database connection file 
    include_once("config.php"); 
    
    // Check if form is submitted for data update, then redirect to homepage after update 
    if(isset($_POST['update'])) { 
        $id = $_POST['id'];
        $id_barang = $_POST['id_barang']; 
        $id_pembeli =$_POST['id_pembeli']; 
        $waktu_beli =$_POST['waktu_beli']; 
        
        // update data 
        $result = mysqli_query($link, "UPDATE pembayaran SET id_barang='$id_barang', id_pembeli='$id_pembeli', waktu_beli='$waktu_beli' WHERE id_pembayaran=$id"); 
        
        // Redirect to homepage to display updated data in list 
        header("Location: homeadmin.php"); }
?>

<?php
    // Display selected minuman based on id 
    // Getting id from url 
    $id = $_GET['id']; 
    
    // Fetch data based on id 
    $result = mysqli_query($link, "SELECT * FROM pembayaran WHERE id_pembayaran=$id");

    while($pembayaran = mysqli_fetch_array($result)) { 
        $id = $pembayaran['id_pembayaran']; 
        $id_barang = $pembayaran['id_barang']; 
        $id_pembeli = $pembayaran['id_pembeli'];
        $waktu_beli = $pembayaran['waktu_beli'];


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
    <h2>Edit Pembeli</h2> 
        <form name="update_pembayaran" method="post" action="editpembayaran.php">
            <table border="0"> 
                <tr>
                    <td>ID Barang</td> 
                    <td><input type="text" name="id_barang" value=<?php echo $id_barang;?>></td>
                </tr> 
                
                <tr>
                    <td>ID Pembeli</td> 
                    <td><input type="text" name="id_pembeli" value=<?php echo $id_pembeli;?>></td> 
                </tr> 

                <tr>
                    <td>Waktu Beli</td> 
                    <td><input type="text" name="waktu_beli" value=<?php echo $waktu_beli;?>></td> 
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