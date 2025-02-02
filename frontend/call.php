<?php
require_once '../backend/auth.php';
if($_SESSION['username'] === 'adminvk'){
  header("Location: host.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PNM Virtual Kiosk</title>
    <link rel="stylesheet" href="styles.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
      integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
      crossorigin="anonymous"
    />
  </head>
  <body class="full-width">
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
        <div class="video-container">
          <video id="local-video" class="blur-filter" autoplay muted></video>
        </div>
        <video id="remote-video" autoplay></video>
      </div>
      <br />
      <div style="text-align: left">
        <p style="display: inline" class="txt-primary">
          Pegawai Bertugas : <b>PERPUSTAKAAN NEGARA MALAYSIA</b>
        </p>
      </div>
    </div>
    <div class="box-white" style="margin-top: 30px">
      <table style="width: 100%; margin-bottom: 30px">
        <tr>
          <td style="text-align: left; width: 60%">
            <h3 class="txt-primary txt-bold" style="margin: 0">
              Pilihan Kemudahan
            </h3>
          </td>
          <td style="text-align: left; width: 40%">
            <h3 class="txt-primary txt-bold" style="margin: 0">
              Rating Kemudahan
            </h3>
          </td>
        </tr>
        <tr>
          <td>
            <div class="toggle-container" style="margin-top: 20px">
              <button
                data-toggle="modal"
                data-target="#exampleModal"
                class="toggle-btn active"
              >
                VR
              </button>
              <button
                data-toggle="modal"
                data-target="#exampleModalTwo"
                class="toggle-btn"
              >
                Perkhidmatan u-Pustaka
              </button>
            </div>
            <div class="toggle-container" style="margin-top: 20px">
              <button
                data-toggle="modal"
                data-target="#exampleModalThree"
                class="toggle-btn"
              >
                Galeri u-Pustaka
              </button>
            </div>
          </td>
          <td>
            <div class="rating">
              <span class="star" data-value="1">★</span>
              <span class="star" data-value="2">★</span>
              <span class="star" data-value="3">★</span>
              <span class="star" data-value="4">★</span>
              <span class="star" data-value="5">★</span>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <a href="end.php" onclick="refreshCall()"
      ><button class="btns btn-end">Tamat</button></a
    >

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Virtual Reality</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>
              Sekiranya tuan/puan memerlukan bantuan tuan/puan boleh menghubungi
              kami menggunakan Kiosk Virtual Counter Galeri u-Pustaka (Selasa
              hingga Jumaat: 10.00 pagi hingga 5.00 petang)
            </p>
            <p>Sila scan QR di bawah untuk melihat video penggunaan VR</p>
            <br />
            <img src="img/vr-qr.png" width="150px" height="auto" />
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="exampleModalTwo"
      tabindex="-1"
      aria-labelledby="exampleModalTwoLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalTwoLabel">
              Perkhidmatan u-Pustaka
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>
              Perkhidmatan u-Pustaka adalah perkhidmatan perpustakaan digital
              negara yang dapat diakses oleh seluruh rakyat Malaysia pada
              bila-bila masa dan di mana-mana sahaja melalui portal u-Pustaka di
              www.u-pustaka.gov.my.
            </p>
            <p>
              Tuan / puan amat dialu-alukan menjadi ahli u-Pustaka. Untuk
              mendaftar sebagai ahli dan maklumat lanjut berkaitan perkhidmatan
              ini, sila imbas QR berikut;
            </p>
            <br />
            <img
              src="img/perkhidmatan-upustaka-qr1.png"
              width="150px"
              height="auto"
              class="mr-5"
            />
            <img
              src="img/perkhidmatan-upustaka-qr2.png"
              width="150px"
              height="auto"
            />
            <!-- <p class="text-muted">Sila scan QR di bawah untuk melihat video penggunaan VR</p> -->
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="exampleModalThree"
      tabindex="-1"
      aria-labelledby="exampleModalThreeLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalThreeLabel">
              Galeri u-Pustaka
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>
              Galeri u-Pustaka Perpustakaan Negara Malaysia (PNM) diwujudkan
              dengan kerjasama Kementerian Komunikasi dan Multimedia Malaysia.
              Galeri ini mula dibuka kepada orang ramai pada 18 Februari 2020
              (Selasa). Pengguna boleh mengakses pelbagain kandungan u-Pustaka
              melalui kemudahan-kemudahan gajet elektronik yang disediakan
              termasuk skrin sentuh pintar, tab dan i-projektor dan lain-lain.
              Selain itu, pengguna juga boleh merasai permainan realiti maya
              (virtual reality). Semua ini disediakan secara percuma.
            </p>
            <p>
              Sekiranya tuan/puan memerlukan bantuan tuan/puan boleh menghubungi
              kami menggunakan Kiosk Virtual Counter Galeri u-Pustaka (Selasa
              hingga Jumaat: 10.00 pagi hingga 5.00 petang)
            </p>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.body.style.backgroundImage = "url('img/bg2.jpg')";

      const buttons = document.querySelectorAll(".toggle-btn");
      buttons.forEach((button) => {
        button.addEventListener("click", () => {
          button.classList.toggle("active");
          const selectedValues = [
            ...document.querySelectorAll(".toggle-btn.active"),
          ].map((btn) => btn.textContent);
          console.log("Selected values:", selectedValues);
        });
      });

      // Get initial selected values
      const getSelectedValues = () => {
        return [...document.querySelectorAll(".toggle-btn.active")].map(
          (btn) => btn.textContent
        );
      };

      const stars = document.querySelectorAll(".star");
      let rating = 0;

      stars.forEach((star) => {
        star.addEventListener("click", (e) => {
          rating = e.target.dataset.value;
          updateStars();
        });
      });

      function updateStars() {
        stars.forEach((star) => {
          star.classList.toggle("active", star.dataset.value <= rating);
        });
      }

      setTimeout(() => {
        window.location.href = "index.php";
      }, 180000); // 3 minutes
    </script>
    <script src="res/peerjs.min.js"></script>
    <script src="res/adapter-latest.js"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/body-pix"></script>
    <script src="app.js"></script>
    <script src="blurFilter.js"></script>
  </body>
</html>
