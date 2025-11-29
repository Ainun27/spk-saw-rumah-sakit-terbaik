<!doctype html>
<html lang="en">

<?php include 'components/head.php'; ?>

<head>
  <style>
    .btn-submit {
      color: green;
      border: 2px solid green;
      background-color: white;
      transition: 0.3s;
      padding: 6px 12px;
      font-size: 16px;
      border-radius: 4px;
      cursor: pointer;
    }

    .btn-submit:hover {
      color: white;
      background-color: green;
      border-color: green;
    }

    .btn-calc {
      color: green;
      border: 2px solid green;
      background-color: white;
      transition: 0.3s;
      padding: 6px 12px;
      font-size: 16px;
      border-radius: 4px;
      cursor: pointer;
    }

    .btn-calc:hover {
      color: white;
      background-color: green;
      border-color: green;
    }
  </style>
</head>

<body>

  <div class="wrapper d-flex align-items-stretch">
    <?php include 'components/sidebar.php'; ?>

    <div id="content" class="p-4 p-md-5">
      <?php include 'components/navbar.php'; ?>

      <section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
              <ol class="breadcrumb">
                <li><i class="fa fa-sticky-note"></i>
                  <a href="kriteria.php" style="color: green;"> Kriteria Penilaian Rumah Sakit</a>
                </li>
              </ol>
            </div>
          </div>

          <!-- START SCRIPT HITUNG -->
          <script>
            function fungsiku() {
              var a = (document.getElementById("fasilitas_param").value).substring(0, 1);
              var b = (document.getElementById("dokter_param").value).substring(0, 1);
              var c = (document.getElementById("jarak_param").value).substring(0, 1);
              var d = (document.getElementById("biaya_param").value).substring(0, 1);
              var e = (document.getElementById("pelayanan_param").value).substring(0, 1);
              var f = (document.getElementById("akreditasi_param").value).substring(0, 1);
              var total = Number(a) + Number(b) + Number(c) + Number(d) + Number(e) + Number(f);
              document.getElementById("fasilitas").value = (Number(a) / total).toFixed(2);
              document.getElementById("dokter").value = (Number(b) / total).toFixed(2);
              document.getElementById("jarak").value = (Number(c) / total).toFixed(2);
              document.getElementById("biaya").value = (Number(d) / total).toFixed(2);
              document.getElementById("pelayanan").value = (Number(e) / total).toFixed(2);
              document.getElementById("akreditasi").value = (Number(f) / total).toFixed(2);
            }
          </script>
          <!-- END SCRIPT HITUNG -->

          <!-- START SCRIPT INSERT -->
          <?php
          include 'koneksi.php';
          if (isset($_POST['submit'])) {
            $fasilitas = $_POST['fasilitas'];
            $dokter = $_POST['dokter'];
            $jarak = $_POST['jarak'];
            $biaya = $_POST['biaya'];
            $pelayanan = $_POST['pelayanan'];
            $akreditasi = $_POST['akreditasi'];

            if (($fasilitas == "") or ($dokter == "") or ($jarak == "") or ($biaya == "") or ($pelayanan == "") or ($akreditasi == "")) {
              echo "<script>alert('Tolong Lengkapi Data yang Ada!');</script>";
            } else {
              $sql = "SELECT * FROM saw_kriteria";
              $hasil = $conn->query($sql);
              if ($hasil->num_rows > 0) {
                echo "<script>alert('Hapus Bobot Lama untuk Membuat Bobot Baru');</script>";
              } else {
                $sql = "INSERT INTO saw_kriteria(fasilitas,dokter,jarak,biaya,pelayanan,akreditasi)
                        values ('$fasilitas','$dokter','$jarak','$biaya','$pelayanan','$akreditasi')";
                $conn->query($sql);
                echo "<script>alert('Bobot Berhasil di Inputkan!');</script>";
              }
            }
          }
          ?>
          <!-- END SCRIPT INSERT -->

          <!-- START FORM INPUTAN -->
          <form class="form-validate form-horizontal" method="post" action="">

            <!-- Judul Kolom -->
            <div class="form-group row">
              <label class="col-sm-2 col-form-label"><b>Kriteria</b></label>
              <div class="col-sm-3"><b>Bobot</b></div>
              <div class="col-sm-2"><b>Perbaikan Bobot</b></div>
            </div>

            <?php
            $kriteria = [
              "Fasilitas Medis" => "fasilitas",
              "Jumlah Dokter Spesialis" => "dokter",
              "Jarak Lokasi" => "jarak",
              "Biaya Perawatan" => "biaya",
              "Kualitas Pelayanan" => "pelayanan",
              "Akreditasi" => "akreditasi"
            ];

            foreach ($kriteria as $label => $name) {
              $param_id = $name . "_param";
              echo '<div class="form-group row">
                      <label class="col-sm-2 col-form-label">' . $label . '</label>
                      <div class="col-sm-3">
                        <select class="form-control" name="' . $param_id . '" id="' . $param_id . '">
                          <option>1. Sangat Rendah</option>
                          <option>2. Rendah</option>
                          <option>3. Cukup</option>
                          <option>4. Tinggi</option>
                          <option>5. Sangat Tinggi</option>
                        </select>
                      </div>
                      <div class="col-sm-1">
                        <input type="text" class="form-control" name="' . $name . '" id="' . $name . '" readonly>
                      </div>';
              if ($name == "akreditasi") {
                echo '<div class="col-sm-2">
                        <button type="button" class="btn-calc" onclick="fungsiku()">
                          <i class="fa fa-calculator"></i> Hitung
                        </button>
                      </div>';
              }
              echo '</div>';
            }
            ?>

            <div class="mb-4">
              <button class="btn-submit" type="submit" name="submit">
                <i class="fa fa-save"></i> Submit
              </button>
            </div>
          </form>
          <!-- END FORM INPUTAN -->

          <!-- TABEL DATA -->
          <table class="table">
            <thead>
              <tr>
                <?php foreach ($kriteria as $label => $name) {
                  echo "<th><i class='fa fa-arrow-down'></i> $label</th>";
                } ?>
                <th><i class="fa fa-cogs"></i> Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM saw_kriteria";
              $hasil = $conn->query($sql);
              if ($hasil->num_rows > 0) {
                while ($row = $hasil->fetch_row()) {
                  echo "<tr>";
                  for ($i = 1; $i <= 6; $i++) {
                    echo "<td align='center'>{$row[$i]}</td>";
                  }
                  echo "<td>
                          <div class='btn-group'>
                            <a class='btn btn-danger' href='kriteria_hapus.php?id={$row[0]}'>
                              <i class='fa fa-close'></i>
                            </a>
                          </div>
                        </td>";
                  echo "</tr>";
                }
              } else {
                echo "<tr><td colspan='7' align='center'>Data Tidak Ada</td></tr>";
              }
              ?>
            </tbody>
          </table>

        </section>
      </section>
    </div>
  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>
