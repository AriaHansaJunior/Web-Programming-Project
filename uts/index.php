<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Halaman Utama</title>
  <style>
    body {
      margin: 0;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .button-container {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    button {
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="button-container">
    <button onclick="window.location.href='setting.php'">Ganti Setting</button>
    <button onclick="window.location.href='hasil.php'">Lihat Hasil</button>
    <form method="post" action="hapus_cookie.php" style="display:inline;">
      <button type="submit">Hapus Cookie</button>
    </form>
  </div>
</body>
</html>
