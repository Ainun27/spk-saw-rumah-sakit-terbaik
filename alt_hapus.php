<?php
include 'koneksi.php';

$nama = $_GET['nama'];

// Hapus dari tabel penilaian dulu (karena ada foreign key)
$sql = "DELETE FROM saw_penilaian WHERE nama='$nama'";
$hasil = $conn->query($sql);

// Kemudian hapus dari tabel rumahsakit
$sql = "DELETE FROM saw_rumahsakit WHERE nama='$nama'";
$hasil = $conn->query($sql);

if ($hasil) {
    echo "<script>
        alert('Data Rumah Sakit berhasil dihapus!'); 
        window.location.href='index.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal menghapus data!'); 
        window.location.href='index.php';
    </script>";
}
?>