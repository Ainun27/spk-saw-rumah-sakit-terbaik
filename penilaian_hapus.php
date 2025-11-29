<?php
include 'koneksi.php';

$nama = $_GET['nama'];

$sql = "DELETE FROM saw_penilaian WHERE nama='$nama'";
$hasil = $conn->query($sql);

if ($hasil) {
    echo "<script>
        alert('Penilaian Rumah Sakit berhasil dihapus!'); 
        window.location.href='penilaian.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal menghapus penilaian!'); 
        window.location.href='penilaian.php';
    </script>";
}
?>