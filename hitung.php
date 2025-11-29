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
                                <li><i class="fa fa-calculator" style="color: green;"></i><a href="hitung.php" style="color: green;"> Perhitungan SAW</a></li> 
                            </ol> 
                        </div> 
                    </div> 
                    
                    <?php
                    include 'koneksi.php';
                    
                    // Cek apakah ada data penilaian
                    $sql_check = "SELECT COUNT(*) as total FROM saw_penilaian";
                    $result_check = $conn->query($sql_check);
                    $row_check = $result_check->fetch_assoc();
                    
                    if ($row_check['total'] == 0) {
                        echo '<div class="alert alert-warning">
                                <strong><i class="fa fa-exclamation-triangle"></i> Peringatan!</strong><br>
                                Belum ada data penilaian. Silakan input data penilaian terlebih dahulu di menu <a href="penilaian.php">Penilaian</a>.
                              </div>';
                    } else {
                        // Cek apakah ada bobot kriteria
                        $sql_bobot = "SELECT COUNT(*) as total FROM saw_kriteria";
                        $result_bobot = $conn->query($sql_bobot);
                        $row_bobot = $result_bobot->fetch_assoc();
                        
                        if ($row_bobot['total'] == 0) {
                            echo '<div class="alert alert-warning">
                                    <strong><i class="fa fa-exclamation-triangle"></i> Peringatan!</strong><br>
                                    Belum ada bobot kriteria. Silakan input bobot kriteria terlebih dahulu di menu <a href="kriteria.php">Kriteria</a>.
                                  </div>';
                        } else {
                    ?>
                    
                    <div> 
                        <b> 
                            <h6><b>MATRIX X - Data Penilaian Rumah Sakit</b></h6> 
                        </b> 
                        <table class="table table-bordered"> 
                            <thead class="thead-light"> 
                                <tr> 
                                    <th><i class="fa fa-arrow-down"></i> No</th> 
                                    <th><i class="fa fa-arrow-down"></i> Nama Rumah Sakit</th> 
                                    <th><i class="fa fa-arrow-down"></i> Fasilitas</th> 
                                    <th><i class="fa fa-arrow-down"></i> Dokter</th> 
                                    <th><i class="fa fa-arrow-down"></i> Jarak</th> 
                                    <th><i class="fa fa-arrow-down"></i> Biaya</th> 
                                    <th><i class="fa fa-arrow-down"></i> Pelayanan</th> 
                                    <th><i class="fa fa-arrow-down"></i> Akreditasi</th> 
                                </tr> 
                            </thead> 
                            <tbody> 
                                <?php 
                                $b = 0; 
                                $sql = "SELECT * FROM saw_penilaian ORDER BY nama ASC"; 
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
                                        </tr> 
                                <?php } 
                                } ?> 
                            </tbody> 
                        </table> 
                    </div> 
                    <div class="mt-4"> 
                        <b> 
                            <h6><b>NORMALISASI (R)</b></h6> 
                        </b> 
                        <p><i>Catatan: Fasilitas, Dokter, Pelayanan, Akreditasi = BENEFIT (Max), Jarak & Biaya = COST (Min)</i></p>
                        <table class="table table-bordered"> 
                            <thead class="thead-light"> 
                                <tr> 
                                    <th><i class="fa fa-arrow-down"></i> No</th> 
                                    <th><i class="fa fa-arrow-down"></i> Nama Rumah Sakit</th> 
                                    <th><i class="fa fa-arrow-down"></i> Fasilitas</th> 
                                    <th><i class="fa fa-arrow-down"></i> Dokter</th> 
                                    <th><i class="fa fa-arrow-down"></i> Jarak</th> 
                                    <th><i class="fa fa-arrow-down"></i> Biaya</th> 
                                    <th><i class="fa fa-arrow-down"></i> Pelayanan</th> 
                                    <th><i class="fa fa-arrow-down"></i> Akreditasi</th> 
                                </tr> 
                            </thead> 
                            <tbody> 
                                <?php 
                                // Query untuk mendapatkan nilai max dan min
                                $sql = "SELECT 
                                    MAX(fasilitas) as max_fasilitas,
                                    MAX(dokter) as max_dokter,
                                    MIN(jarak) as min_jarak,
                                    MIN(biaya) as min_biaya,
                                    MAX(pelayanan) as max_pelayanan,
                                    MAX(akreditasi) as max_akreditasi
                                    FROM saw_penilaian"; 
                                $hasil = $conn->query($sql); 
                                $max_min = $hasil->fetch_assoc();
                                
                                $b = 0; 
                                $sql = "SELECT * FROM saw_penilaian ORDER BY nama ASC"; 
                                $hasil = $conn->query($sql); 
                                $rows = $hasil->num_rows; 
                                if ($rows > 0) { 
                                    while ($row = $hasil->fetch_row()) {
                                        // Normalisasi BENEFIT (dibagi max)
                                        $r_fasilitas = $max_min['max_fasilitas'] > 0 ? $row[1] / $max_min['max_fasilitas'] : 0;
                                        $r_dokter = $max_min['max_dokter'] > 0 ? $row[2] / $max_min['max_dokter'] : 0;
                                        $r_pelayanan = $max_min['max_pelayanan'] > 0 ? $row[5] / $max_min['max_pelayanan'] : 0;
                                        $r_akreditasi = $max_min['max_akreditasi'] > 0 ? $row[6] / $max_min['max_akreditasi'] : 0;
                                        
                                        // Normalisasi COST (min dibagi nilai)
                                        $r_jarak = $row[3] > 0 ? $max_min['min_jarak'] / $row[3] : 0;
                                        $r_biaya = $row[4] > 0 ? $max_min['min_biaya'] / $row[4] : 0;
                                ?> 
                                        <tr> 
                                            <td align="center"><?php echo $b = $b + 1; ?></td> 
                                            <td><?= $row[0] ?></td> 
                                            <td align="center"><?= number_format($r_fasilitas, 4) ?></td> 
                                            <td align="center"><?= number_format($r_dokter, 4) ?></td> 
                                            <td align="center"><?= number_format($r_jarak, 4) ?></td> 
                                            <td align="center"><?= number_format($r_biaya, 4) ?></td> 
                                            <td align="center"><?= number_format($r_pelayanan, 4) ?></td> 
                                            <td align="center"><?= number_format($r_akreditasi, 4) ?></td> 
                                        </tr> 
                                <?php } 
                                } ?> 
                            </tbody> 
                        </table> 
                    </div>
                    
                    <div class="mt-4"> 
                        <b> 
                            <h6><b>PERANGKINGAN - Hasil Akhir</b></h6> 
                        </b> 
                        <table class="table table-bordered"> 
                            <thead class="thead-dark"> 
                                <tr> 
                                    <th>Ranking</th> 
                                    <th>Nama Rumah Sakit</th> 
                                    <th>Nilai Akhir</th> 
                                </tr> 
                            </thead> 
                            <tbody> 
                                <?php 
                                // Ambil bobot kriteria
                                $sql = "SELECT * FROM saw_kriteria LIMIT 1"; 
                                $hasil = $conn->query($sql); 
                                $bobot = $hasil->fetch_assoc();
                                
                                // Hitung nilai akhir untuk setiap alternatif
                                $hasil_akhir = array();
                                
                                $sql = "SELECT * FROM saw_penilaian ORDER BY nama ASC"; 
                                $hasil = $conn->query($sql); 
                                while ($row = $hasil->fetch_row()) {
                                    // Normalisasi
                                    $r_fasilitas = $max_min['max_fasilitas'] > 0 ? $row[1] / $max_min['max_fasilitas'] : 0;
                                    $r_dokter = $max_min['max_dokter'] > 0 ? $row[2] / $max_min['max_dokter'] : 0;
                                    $r_jarak = $row[3] > 0 ? $max_min['min_jarak'] / $row[3] : 0;
                                    $r_biaya = $row[4] > 0 ? $max_min['min_biaya'] / $row[4] : 0;
                                    $r_pelayanan = $max_min['max_pelayanan'] > 0 ? $row[5] / $max_min['max_pelayanan'] : 0;
                                    $r_akreditasi = $max_min['max_akreditasi'] > 0 ? $row[6] / $max_min['max_akreditasi'] : 0;
                                    
                                    // Kalikan dengan bobot dan jumlahkan
                                    $nilai = ($r_fasilitas * $bobot['fasilitas']) +
                                             ($r_dokter * $bobot['dokter']) +
                                             ($r_jarak * $bobot['jarak']) +
                                             ($r_biaya * $bobot['biaya']) +
                                             ($r_pelayanan * $bobot['pelayanan']) +
                                             ($r_akreditasi * $bobot['akreditasi']);
                                    
                                    $hasil_akhir[] = array(
                                        'nama' => $row[0],
                                        'nilai' => $nilai
                                    );
                                }
                                
                                // Urutkan dari nilai tertinggi
                                usort($hasil_akhir, function($a, $b) {
                                    return $b['nilai'] <=> $a['nilai'];
                                });
                                
                                // Tampilkan hasil
                                $ranking = 1;
                                foreach($hasil_akhir as $hasil) {
                                    $class = $ranking == 1 ? 'table-success' : '';
                                ?>
                                    <tr class="<?= $class ?>">
                                        <td align="center"><strong><?= $ranking ?></strong></td>
                                        <td><?= $hasil['nama'] ?></td>
                                        <td align="center"><strong><?= number_format($hasil['nilai'], 4) ?></strong></td>
                                    </tr>
                                <?php 
                                    $ranking++;
                                } 
                                ?> 
                            </tbody> 
                        </table>
                        <?php if (count($hasil_akhir) > 0) { ?>
                        <div class="alert alert-success">
                            <strong><i class="fa fa-trophy"></i> Kesimpulan:</strong> 
                            Rumah Sakit terbaik adalah <strong><?= $hasil_akhir[0]['nama'] ?></strong> dengan nilai <strong><?= number_format($hasil_akhir[0]['nilai'], 4) ?></strong>
                        </div>
                        <?php } ?>
                    </div>
                    
                    <?php 
                        } // end if bobot
                    } // end if penilaian
                    ?> 
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