<?php
setcookie('setting', '', time() - 3600, '/');
header("Location: index.php");
exit;
