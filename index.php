<!doctype html>
<html lang="en">
<head>
  <?php include 'components/head.php'; ?>
  <style>
    .btn-submit {
        color: green;
        border: 2px solid green;
        background-color: white;
        transition: 0.3s;
    }

    .btn-submit:hover {
        color: white;
        background-color: green;
        border-color: green;
    }
  </style>
</head>
<body>

<div class="wrapper d-flex align-items-stretch">
  <?php include 'components/sidebar.php'; ?>

  <!-- Page Content  -->
  <div id="content" class="p-4 p-md-5">
    <?php include 'components/navbar.php'; ?>

    <section id="main-content">
      <section class="wrapper">
        <!--overview start-->
        <div class="row">
          <div class="col-lg-12">
            <ol class="breadcrumb">
              <li><i class="fa fa-hospital-o"></i><a href="index.php" style="color: green;"> Alternatif Rumah Sakit</a></li>
            </ol>
          </div>
        </div>

        <!--START SCRIPT INSERT-->
        <?php
        include 'koneksi.php';
        if (isset($_POST['submit'])) {
          $nama = $_POST['nama'];
          $alamat = $_POST['alamat'];
          $tipe = $_POST['tipe'];
          if (($nama == "") or ($alamat == "")) {
            echo "<script>alert('Tolong Lengkapi Data yang Ada!');</script>";
          } else {
            $sql = "SELECT * FROM saw_rumahsakit WHERE nama='$nama'";
            $hasil = $conn->query($sql);
            $rows = $hasil->num_rows;
            if ($rows > 0) {
              $row = $hasil->fetch_row();
              echo "<script>alert('Rumah Sakit $nama Sudah Ada!');</script>";
            } else {
              $sql = "INSERT INTO saw_rumahsakit(nama,alamat,tipe)
                      values ('" . $nama . "','" . $alamat . "','" . $tipe . "')";
              $hasil = $conn->query($sql);
              echo "<script>alert('Data Berhasil diTambahkan!');</script>";
            }
          }
        }
        ?>
        <!-- END SCRIPT INSERT-->

        <!--start inputan-->
        <form method="POST" action="">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama Rumah Sakit</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="nama" placeholder="Contoh: RS Harapan Sehat">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Alamat Rumah Sakit</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="alamat" placeholder="Contoh: Jl. Merdeka No. 123">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tipe Rumah Sakit</label>
            <div class="col-sm-5">
              <select class="form-control" name="tipe">
                <option>RS Tipe A</option>
                <option>RS Tipe B</option>
                <option>RS Tipe C</option>
                <option>RS Tipe D</option>
                <option>RS Khusus</option>
              </select>
            </div>
          </div>
          <div class="mb-4">
            <!-- tombol submit hijau -->
            <button type="submit" name="submit" class="btn-submit">
              <i class="fa fa-save"></i> Submit
            </button>
          </div>
        </form>

        <!-- tabel data -->
        <table class="table">
          <thead>
            <tr>
              <th><i class="fa fa-arrow-down"></i> No</th>
              <th><i class="fa fa-arrow-down"></i> Nama Rumah Sakit</th>
              <th><i class="fa fa-arrow-down"></i> Alamat</th>
              <th><i class="fa fa-arrow-down"></i> Tipe</th>
              <th><i class="fa fa-cogs"></i> Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $b = 0;
            $sql = "SELECT*FROM saw_rumahsakit ORDER BY nama ASC";
            $hasil = $conn->query($sql);
            $rows = $hasil->num_rows;
            if ($rows > 0) {
              while ($row = $hasil->fetch_row()) {
            ?>
                <tr>
                  <td><?php echo $b = $b + 1; ?></td>
                  <td><?= $row[0] ?></td>
                  <td><?= $row[1] ?></td>
                  <td><?= $row[2] ?></td>
                  <td>
                    <div class="btn-group">
                      <a class="btn btn-success" href="alt_ubah.php?nama=<?= $row[0] ?>"><i class="fa fa-edit"></i></a>
                      <a class="btn btn-danger" href="alt_hapus.php?nama=<?= $row[0] ?>"><i class="fa fa-trash"></i></a>
                    </div>
                  </td>
                </tr>
            <?php }
            } else {
              echo "<tr><td colspan='5' align='center'>Data Tidak Ada</td><tr>";
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
