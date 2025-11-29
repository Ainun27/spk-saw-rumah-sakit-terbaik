<!doctype html>
<html lang="en">

<?php
include 'components/head.php';
?>

<body>

  <div class="wrapper d-flex align-items-stretch">
    <?php
    include 'components/sidebar.php';
    ?>

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">

      <?php
      include 'components/navbar.php';
      ?>

      <section id="main-content">
        <section class="wrapper">
          <!--overview start-->
          <div class="row">
            <div class="col-lg-12">
              <ol class="breadcrumb">
                <li><i class="fa fa-list-ol" style="color: green;"></i><a href="penilaian.php" style="color: green;"> Penilaian Rumah Sakit</a></li>
              </ol>
            </div>
          </div>

          <!--START SCRIPT INSERT-->
          <?php

          include 'koneksi.php';

          if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            $fasilitas = substr($_POST['fasilitas'], 1, 1);
            $dokter = substr($_POST['dokter'], 1, 1);
            $jarak = substr($_POST['jarak'], 1, 1);
            $biaya = substr($_POST['biaya'], 1, 1);
            $pelayanan = substr($_POST['pelayanan'], 1, 1);
            $akreditasi = substr($_POST['akreditasi'], 1, 1);
            if ($nama == "" || $fasilitas == "" || $dokter == "" || $jarak == "" || $biaya == "" || $pelayanan == "" || $akreditasi == "") {
              echo "<script>
              alert('Tolong Lengkapi Data yang Ada!');
              </script>";
            } else {
              $sql = "SELECT*FROM saw_penilaian WHERE nama='$nama'";
              $hasil = $conn->query($sql);
              $rows = $hasil->num_rows;
              if ($rows > 0) {
                $row = $hasil->fetch_row();
                echo "<script>
                alert('Rumah Sakit $nama sudah dinilai!');
                </script>";
              } else {
                //insert penilaian
                $sql = "INSERT INTO saw_penilaian(
                nama,fasilitas,dokter,jarak,biaya,pelayanan,akreditasi)
                values ('" . $nama . "',
                '" . $fasilitas . "',
                '" . $dokter . "',
                '" . $jarak . "',
                '" . $biaya . "',
                '" . $pelayanan . "',
                '" . $akreditasi . "')";
                $hasil = $conn->query($sql);
                echo "<script>
                alert('Penilaian Berhasil di Tambahkan!');
                </script>";
              }
            }
          }
          ?>
          <!-- END SCRIPT INSERT-->

          <!--start inputan-->
          <form method="POST" action="">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Pilih Rumah Sakit</label>
              <div class="col-sm-4">
                <select class="form-control" name="nama" required>
                  <option value="">-- Pilih Rumah Sakit --</option>
                  <?php
                  //load nama rumah sakit
                  $sql = "SELECT * FROM saw_rumahsakit ORDER BY nama ASC";
                  $hasil = $conn->query($sql);
                  $rows = $hasil->num_rows;
                  if ($rows > 0) {
                    while ($row = mysqli_fetch_array($hasil)) { ?> 
                      <option><?php echo $row[0]; ?></option>
                  <?php }
                  } ?>
                </select>
              </div>
            </div>
            <div class="alert alert-success" style="background-color: #d4edda; background-color: #77f093ff; border-color: #c3e6cb;">
              <strong>Petunjuk Penilaian:</strong> Berikan nilai untuk setiap kriteria dengan skala 1-5
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Fasilitas Medis</label>
              <div class="col-sm-4">
                <select class="form-control" name="fasilitas" required>
                  <option>(1) Sangat Kurang</option>
                  <option>(2) Kurang</option>
                  <option>(3) Cukup</option>
                  <option>(4) Baik</option>
                  <option>(5) Sangat Baik</option>
                </select>
              </div>
              <div class="col-sm-6">
                <small class="text-muted">Kelengkapan alat medis, ruang IGD, ruang operasi, dll</small>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Jumlah Dokter Spesialis</label>
              <div class="col-sm-4">
                <select class="form-control" name="dokter" required>
                  <option>(1) Sangat Sedikit</option>
                  <option>(2) Sedikit</option>
                  <option>(3) Cukup</option>
                  <option>(4) Banyak</option>
                  <option>(5) Sangat Banyak</option>
                </select>
              </div>
              <div class="col-sm-6">
                <small class="text-muted">Ketersediaan dokter spesialis berbagai bidang</small>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Jarak Lokasi</label>
              <div class="col-sm-4">
                <select class="form-control" name="jarak" required>
                  <option>(1) Sangat Jauh (>20 km)</option>
                  <option>(2) Jauh (15-20 km)</option>
                  <option>(3) Sedang (10-15 km)</option>
                  <option>(4) Dekat (5-10 km)</option>
                  <option>(5) Sangat Dekat (<5 km)</option>
                </select>
              </div>
              <div class="col-sm-6">
                <small class="text-muted">Jarak dari lokasi Anda (semakin dekat semakin baik)</small>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Biaya Perawatan</label>
              <div class="col-sm-4">
                <select class="form-control" name="biaya" required>
                  <option>(1) Sangat Mahal</option>
                  <option>(2) Mahal</option>
                  <option>(3) Sedang</option>
                  <option>(4) Murah</option>
                  <option>(5) Sangat Murah</option>
                </select>
              </div>
              <div class="col-sm-6">
                <small class="text-muted">Tarif rawat inap, operasi, dan layanan medis (semakin murah semakin baik)</small>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Kualitas Pelayanan</label>
              <div class="col-sm-4">
                <select class="form-control" name="pelayanan" required>
                  <option>(1) Sangat Buruk</option>
                  <option>(2) Buruk</option>
                  <option>(3) Cukup</option>
                  <option>(4) Baik</option>
                  <option>(5) Sangat Baik</option>
                </select>
              </div>
              <div class="col-sm-6">
                <small class="text-muted">Keramahan staff, kecepatan layanan, kebersihan, dll</small>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Akreditasi</label>
              <div class="col-sm-4">
                <select class="form-control" name="akreditasi" required>
                  <option>(1) Tidak Terakreditasi</option>
                  <option>(2) Akreditasi Dasar</option>
                  <option>(3) Akreditasi Madya</option>
                  <option>(4) Akreditasi Utama</option>
                  <option>(5) Akreditasi Paripurna</option>
                </select>
              </div>
              <div class="col-sm-6">
                <small class="text-muted">Status akreditasi dari KARS (Komisi Akreditasi Rumah Sakit)</small>
              </div>
            </div>
            <div class="mb-4">
              <button type="submit" name="submit" class="btn-submit">
                <i class="fa fa-save"></i> Submit Penilaian
              </button>
            </div>

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
            </style>

          </form>

          <table class="table table-striped">
            <thead>
              <tr>
                <th><i class="fa fa-arrow-down"></i> No</th>
                <th><i class="fa fa-arrow-down"></i> Nama Rumah Sakit</th>
                <th><i class="fa fa-arrow-down"></i> Fasilitas</th>
                <th><i class="fa fa-arrow-down"></i> Dokter</th>
                <th><i class="fa fa-arrow-down"></i> Jarak</th>
                <th><i class="fa fa-arrow-down"></i> Biaya</th>
                <th><i class="fa fa-arrow-down"></i> Pelayanan</th>
                <th><i class="fa fa-arrow-down"></i> Akreditasi</th>
                <th><i class="fa fa-cogs"></i> Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $b = 0;
              $sql = "SELECT*FROM saw_penilaian ORDER BY nama ASC";
              $hasil = $conn->query($sql);
              $rows = $hasil->num_rows;
              if ($rows > 0) {
                while ($row = $hasil->fetch_row()) {
              ?>
                  <tr>
                    <td align="center"><?php echo $b = $b + 1; ?></td>
                    <td><?= $row[0] ?></td>
                    <td align="center"><?= $row[1] ?></td>
                    <td align="center"><?= $row[2] ?></td>
                    <td align="center"><?= $row[3] ?></td>
                    <td align="center"><?= $row[4] ?></td>
                    <td align="center"><?= $row[5] ?></td>
                    <td align="center"><?= $row[6] ?></td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-danger" href="penilaian_hapus.php?nama=<?= $row[0] ?>">
                          <i class="fa fa-close"></i></a>
                      </div>
                    </td>
                  </tr>
              <?php }
              } else {
                echo "<tr>
                    <td colspan='9' align='center'>Data Tidak Ada</td>
                <tr>";
              } ?>
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
