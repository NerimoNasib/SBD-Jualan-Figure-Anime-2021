<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Pembayaran</title>
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
                padding: 10px 10px 10px 10px;
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
        <a href="homeadmin.php">Home Admin</a> 
        <br/><br/>

        <div class="Tabel">
        <h2>Tambah Nota Pembayaran</h2>
        <form action="addpembayaran.php" method="post" name="form1"> 
            <table width="25%" border="0"> 
                <tr>
                    <td>ID Barang</td>
                    <td><input type="text" name="id_barang"></td> 
                </tr> 
                <tr>
                    <td>ID Pembeli</td> 
                    <td><input type="text" name="id_pembeli"></td> 
                </tr>
                <tr>
                    <td>Waktu beli</td> 
                    <td><input type="text" name="waktu_beli"></td> 
                </tr>
                
                <tr>
                    <td></td> 
                    <td><input type="submit" name="Submit" value="Add"></td> 
                </tr> 
            </table> 
        </form>
        </div>

        <?php
            // Check If form submitted, insert form data into users table.
            if(isset($_POST['Submit'])) { 
                $id_barang = $_POST['id_barang']; 
                $id_pembeli = $_POST['id_pembeli'];
                $waktu_beli = $_POST['waktu_beli'];


                // include database connection file 
                include_once("config.php");

                // Insert user data into table 
                $result = mysqli_query($link, "INSERT INTO pembayaran(id_barang, id_pembeli, waktu_beli) VALUES('$id_barang', '$id_pembeli', '$waktu_beli')"); 
                // Show message when user added 
                echo "Berhasil menambahkan ke Pembayaran! <br><a href='homeadmin.php'>Kembali ke Home Admin</a>"; 
            }
        ?>
    </body>
</html>
