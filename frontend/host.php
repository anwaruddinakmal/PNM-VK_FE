<?php
require_once '../backend/auth.php';
if($_SESSION['username'] === 'client'){
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - PNM Virtual Kiosk</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
      integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <div class="container-lg">
      <div class="box-white">
        <table style="width: 100%; margin-bottom: 30px">
          <tr>
            <td style="text-align: left; width: 90%">
              <h3 class="txt-primary txt-bold" style="margin: 0">
                Khidmat Pelanggan Online
              </h3>
            </td>
            <td>
              <div class="recording-container">
                <div class="recording-dot"></div>
                Live
              </div>
            </td>
          </tr>
        </table>
        <div class="remote-container">
          <video id="local-video" autoplay muted></video>
          <video id="remote-video" autoplay></video>
        </div>
      </div>
      <button
        class="btns btn-accept"
        id="btn-accept-host"
        style="display: none"
      >
        Terima
      </button>
      <a href="host.html"
        ><button class="btns btn-end" id="btn-end-host" style="display: none">
          Tamat
        </button></a
      >
    </div>
    <script src="res/peerjs.min.js"></script>
    <script src="res/adapter-latest.js"></script>
    <script src="app.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
      crossorigin="anonymous"
    ></script>
    <script>
      document.body.style.backgroundImage = "url('img/bg2.jpg')";
    </script>
  </body>
</html>
