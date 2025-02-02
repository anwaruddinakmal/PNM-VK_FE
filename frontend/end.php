<?php
require_once '../backend/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PNM Virtual Kiosk</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body class="full-width">
    <div class="box-end">
      <h3>Terima Kasih Kerana Menggunakan</h3>
      <h1>GALERI u-PUSTAKA PERPUSTAKAAN NEGARA MALAYSIA</h1>
    </div>
    <script>
      document.body.style.backgroundImage = "url('img/bg2.jpg')";
      setTimeout(() => {
        window.location.href = "index.php"; // Replace with your target URL
      }, 5000);
    </script>
  </body>
</html>
