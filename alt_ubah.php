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
                                <li><i class="fa fa-edit"></i><a href="alt_ubah.php"> Edit Rumah Sakit</a></li>
                            </ol>
                        </div>
                    </div>

                    <!--START SCRIPT UPDATE-->
                    <?php
                    include 'koneksi.php';

                    if (isset($_POST['edit'])) {
                        $first_nama = $_GET['nama'];
                        $nama = $_POST['nama'];
                        $alamat = $_POST['alamat'];
                        $tipe = $_POST['tipe'];
                        if (($nama == "") or ($alamat == "")) {
                            echo "<script>
                            alert('Tolong lengkapi data yang ada!');
                            </script>";
                        } else {
                            $sql = "UPDATE saw_rumahsakit SET nama='$nama', alamat='$alamat', tipe='$tipe' 
                                    WHERE nama='$first_nama'";
                            $hasil = $conn->query($sql);
                            if ($hasil) {
                                echo "<script>
                                alert('Data Rumah Sakit berhasil di update!');
                                window.location.href='index.php'; 
                                </script>";
                            }
                        }
                    }
                    ?>
                    <!-- END SCRIPT UPDATE-->

                    <!--start inputan-->
                    <form method="POST" action="">
                        <?php
                        $nama = $_GET['nama'];
                        $sql = "SELECT * FROM saw_rumahsakit WHERE nama = '$nama'";
                        $hasil = $conn->query($sql);
                        $rows = $hasil->num_rows;
                        if ($rows > 0) {
                            $row = $hasil->fetch_row();
                            $nama = $row[0];
                            $alamat = $row[1];
                            $tipe = $row[2];
                        ?>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Rumah Sakit</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nama" value="<?= $nama ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Alamat Rumah Sakit</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="alamat" value="<?= $alamat ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tipe Rumah Sakit</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="tipe" required>
                                        <option <?php if ($tipe == 'RS Tipe A') echo 'selected'; ?>>RS Tipe A</option>
                                        <option <?php if ($tipe == 'RS Tipe B') echo 'selected'; ?>>RS Tipe B</option>
                                        <option <?php if ($tipe == 'RS Tipe C') echo 'selected'; ?>>RS Tipe C</option>
                                        <option <?php if ($tipe == 'RS Tipe D') echo 'selected'; ?>>RS Tipe D</option>
                                        <option <?php if ($tipe == 'RS Khusus') echo 'selected'; ?>>RS Khusus</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <a href="index.php" class="btn btn-outline-danger mr-3"><i class="fa fa-close"></i> Cancel</a>
                                <button type="submit" name="edit" class="btn btn-outline-primary"><i class="fa fa-edit"></i> Update</button>
                            </div>
                    </form>
                <?php } else {
                            echo "<div class='alert alert-warning'>Data tidak ditemukan!</div>";
                        } ?>
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