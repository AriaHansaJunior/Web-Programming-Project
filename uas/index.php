<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .center{
            margin: auto;
            width: 240px;
            border: 3px solid black;
            padding: 10px;
            top: 30%;
            left: 41.5%;
            position: absolute;
            
        }
        .good_notif{
            margin: auto;
            background-color: darkgreen;
            opacity: 0.7;
            padding: 10px;
            width: 160px;
            border-radius: 10px;
        }
        .bad_notif{
            margin: auto;
            background-color: darkred;
            opacity: 0.7;
            padding: 10px;
            width: 160px;
            border-radius: 10px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php
    if(isset($_SESSION['notification'])){
        if($_SESSION['notification'] == 'Tolong data makanan diisi dengan lengkap'){
            echo '<div class="bad_notif" id="notification">
            <span style="color:white;">' . htmlspecialchars($_SESSION['notification']) . '</span>
            </div>';
            unset($_SESSION['notification']);
        }
        else{
            echo '<div class="good_notif" id="notification">
            <span style="color:white;">' . htmlspecialchars($_SESSION['notification']) . '</span>
            </div>';
            unset($_SESSION['notification']);
        }
    }
    ?>
        
        <script>
            $(document).ready(function () {
                $("#notification").fadeOut(5000);
            });
        </script>

        <?php
    ?>
    <div class = "center">
        <h2 style="text-align:center;">Tambah Makanan</h2>
        <form action = "order.php" method = "post">
        <p><label style=" margin-left: 16px;" for = "kode">Kode : </label>
        <input id="kode" type = "text" name = "kode"></p>
        <p><label style=" margin-left: 13px;" for = "nama">Nama : </label>
        <input id="nama" type = "text" name = "nama"></p>
        <p><label style=" margin-left: 13px;" for = "harga">Harga : </label>
        <input id="harga" type = "number" step ="1000" name = "harga"></p>
        <p><label for = "gambar">Gambar : </label>
        <input id="gambar" type = "url" name = "gambar"></p>
        <a href="order.php">Order</a>
        <input style="margin-left: 173px;" type="submit" name = "submit" value = "Simpan">
        </form>
    </div>
</body>
</html>
