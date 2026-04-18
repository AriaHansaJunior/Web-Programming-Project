<?php
$cssData = isset($_COOKIE['setting']) ? urldecode($_COOKIE['setting']) : '';

$defaultCSS = "text-align: left; font-family: Arial; color: #000000;";
$defaultText = "p {\n  text-align: left;\n  font-family: Arial;\n  color: #000000;\n}";

if ($cssData) {
    $rules = array_filter(array_map('trim', explode(';', $cssData)));
    $cssStyle = implode('; ', $rules) . ';';

    $displayText = "p {\n";
    foreach ($rules as $rule) {
        if (!empty($rule)) {
            $displayText .= "  $rule;\n";
        }
    }
    $displayText .= "}";
} else {
    $cssStyle = $defaultCSS;
    $displayText = $defaultText;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Halaman Hasil</title>
  <style>
    p.contoh-paragraf {
      <?= $cssStyle ?>
    }
  </style>
</head>
<body>
  <h2>Halaman Hasil</h2>

  <p>Setting yang tersedia:</p>
  <textarea readonly rows="6" cols="50"><?= htmlspecialchars($displayText) ?></textarea>

  <br><br>
  <a href="setting.php">Ganti Setting</a> |
  <a href="index.php">Kembali ke halaman utama</a>

  <br><br>
  <p><strong>Contoh paragraf:</strong></p>
  <p class="contoh-paragraf">
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas orci mauris, commodo quis turpis sed, imperdiet aliquet metus. Nullam mollis gravida dui, non tempor sapien tempus in. Aenean a risus dignissim, hendrerit lectus sed, maximus ex.
  </p>
</body>
</html>
