<?php
include 'koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM saw_kriteria WHERE id='$id'";
$hasil = $conn->query($sql);

if ($hasil) {
    echo "<script>
        alert('Bobot Kriteria berhasil dihapus!'); 
        window.location.href='kriteria.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal menghapus bobot kriteria!'); 
        window.location.href='kriteria.php';
    </script>";
}
?>