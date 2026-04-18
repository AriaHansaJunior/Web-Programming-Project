<?php
// Ambil data cookie kalau ada
$cssData = isset($_COOKIE['setting']) ? urldecode($_COOKIE['setting']) : '';
$textAlign = 'left';
$fontFamily = 'Arial';
$fontColor = '#000000';

// Ambil nilai dari cookie jika ada
if ($cssData) {
    $styles = explode(';', $cssData);
    foreach ($styles as $style) {
        $style = trim($style);
        if (stripos($style, 'text-align:') === 0) $textAlign = trim(substr($style, 11));
        if (stripos($style, 'font-family:') === 0) $fontFamily = trim(substr($style, 12));
        if (stripos($style, 'color:') === 0) $fontColor = trim(substr($style, 6));
    }
}

// Simpan data dari form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $allowedAlign = ['left', 'right', 'center', 'justify'];
    $allowedFonts = ['Arial', 'Tahoma', 'Calibri'];

    $textAlign = in_array($_POST['textalign'] ?? '', $allowedAlign) ? $_POST['textalign'] : 'left';
    $fontFamily = in_array($_POST['fontfamily'] ?? '', $allowedFonts) ? $_POST['fontfamily'] : 'Arial';
    $fontColor = $_POST['fontcolor'] ?? '#000000';

    $cssData = "text-align: $textAlign; font-family: $fontFamily; color: $fontColor;";
    setcookie('setting', urlencode($cssData), time() + (86400 * 30), "/");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Setting</title>
</head>
<body>
  <h2>Halaman Setting</h2>

  <form method="post" action="setting.php">
    <p>Text-align:</p>
    <select name="textalign" required>
      <option value="">-- Pilih Text Align --</option>
      <option value="left" <?= $textAlign === 'left' ? 'selected' : '' ?>>Left</option>
      <option value="right" <?= $textAlign === 'right' ? 'selected' : '' ?>>Right</option>
      <option value="center" <?= $textAlign === 'center' ? 'selected' : '' ?>>Center</option>
      <option value="justify" <?= $textAlign === 'justify' ? 'selected' : '' ?>>Justify</option>
    </select>

    <br><br>

    <p>Font-family:</p>
    <select name="fontfamily" required>
      <option value="">-- Pilih Font Family --</option>
      <option value="Arial" <?= $fontFamily === 'Arial' ? 'selected' : '' ?>>Arial</option>
      <option value="Tahoma" <?= $fontFamily === 'Tahoma' ? 'selected' : '' ?>>Tahoma</option>
      <option value="Calibri" <?= $fontFamily === 'Calibri' ? 'selected' : '' ?>>Calibri</option>
    </select>

    <br><br>

    <p>Color:</p>
    <input type="color" name="fontcolor" value="<?= htmlspecialchars($fontColor) ?>">

    <br><br>
    <input type="submit" value="Simpan">
  </form>

  <br>
  <p><a href="index.php">Kembali ke halaman utama</a></p>
</body>
</html>
