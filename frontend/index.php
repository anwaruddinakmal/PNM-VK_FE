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
  <body>
    <div class="container">
      <div class="box-white box-mula">
        <h1 class="txt-primary txt-bold">Guna Peralatan VR</h1>
        <p class="txt-primary">
          Sila tekan mula untuk meneruskan<br>penggunaan VR
        </p>
        <a href="call.php"><button class="btns btn-mula">Mula</button></a>
      </div>
    </div>
    <script>
      document.body.style.backgroundImage = "url('img/bg-home-new.png')";
    </script>
  </body>
</html>
