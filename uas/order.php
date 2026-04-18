
<?php
session_start();

if (!isset($_SESSION['arr_makanan'])) {
    $_SESSION['arr_makanan'] = array();
}

if(isset($_POST['submit'])){
    if(empty($_POST['kode']) || empty($_POST['nama']) || empty($_POST['gambar'])) {
        $_SESSION['notification'] = 'Tolong data makanan diisi dengan lengkap';
        header("location:index.php");
        exit();
    }
    else if(empty($_SESSION['arr_makanan'])) {
        $_SESSION['arr_makanan'] = array(array('kode' => $_POST['kode'], 'nama' => $_POST['nama'], 'harga' => $_POST['harga'], 'gambar' => $_POST['gambar']));
        $_SESSION['notification'] = 'Makanan telah disimpan';
        header("location:index.php");
        exit();
    }
    else {
        $adaMakanan = false;
        foreach ($_SESSION['arr_makanan'] as $makanan) {
            if ($makanan['kode'] === $_POST['kode']) {
                $adaMakanan = true;
                break;
            }
        }

        if (!$adaMakanan) {
            $_SESSION['arr_makanan'][] = array('kode' => $_POST['kode'], 'nama' => $_POST['nama'], 'harga' => $_POST['harga'], 'gambar' => $_POST['gambar']);
            $_SESSION['notification'] = 'Makanan telah disimpan';
        } else {
            $_SESSION['notification'] = 'Makanan dengan kode tersebut sudah ada.';
        }
        header("location:index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projek UAS</title>
    <style>
        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            width: 95%;
            margin: auto;
            margin-top: 20px;
        }
        .menu {
            display: flex;
            flex-wrap: wrap;
            width: 75%;
        }
        .kartu {
            border: solid;
            padding: 5px;
            margin: 5px;
            width: 180px;
            text-align: center;
            height: 215px;
        }
        img{
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 20px;
            max-height : 100px;
            max-width: 150px;
            min-height : 100px;
            min-width: 150px;
        }
        .hasil {
            width: 250px;
            padding: 10px;
            height: fit-content;
            margin-top: 6px;
            position: fixed;
            left: 70%;
        }
        button {
            margin-top: 10px;
        }
        .status {
            margin-top: 5px;
            color: green;
            font-weight: bold;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container">
    <div class="menu">
        <?php
        if (!empty($_SESSION['arr_makanan'])) {
            $p = 1;
            foreach ($_SESSION['arr_makanan'] as $index => $item) {
               echo '<div class="kartu">';
               echo '  <img src = "'.$item['gambar'].'">';
               echo '  <div><strong>' . $item["nama"] . '</strong></div>';
               echo '  <div>Rp. ' . number_format($item["harga"], 0, ',', '.') . '</div>';
               echo '  <button class="tambah" data-harga="' . $item["harga"] . '" data-nama="' . $item["nama"] . '">Pilih</button>';
               echo '  <div class="status" id="status-' . $index . '"></div>';
               echo '</div>';
                $p = $p + 1;
            }
        }
        else {
        echo '<h1>No food items available yet. Please add some!</h1>';

    }
    ?>
   </div>
        <div class="hasil">
            <strong>Pilihanku:</strong>
            <ul id="daftar-pilihanku"></ul>
            <p>_______________________________</p>
            <p>Total Harga: Rp. <span id="total-harga">0</span></p>
            <a href = "index.php">Kembali ke Tambah Menu</a>
        </div>
</div>
<script>
    var total = 0;
    $(document).ready(function () {
        $(".tambah").click(function () {
            let harga = parseInt($(this).data("harga"));
            let nama = $(this).data("nama");
            let statusDiv = $(this).siblings(".status");
            $(this).prop('disabled', true);
            if (statusDiv.text() !== "Sudah Ditambahkan") {
                total += harga;
                $("#total-harga").text(total.toLocaleString('id-ID'));
                statusDiv.text("Sudah Ditambahkan");
                $("#daftar-pilihanku").append("<li>" + nama + " (" + harga + ") </li>");
            }
        });
    });
</script>
</body>
</html>

