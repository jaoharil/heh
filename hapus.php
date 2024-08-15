<?php
// panggil file database.php untuk koneksi ke database
require_once "config/koneksi.php";

// pastikan ID ada di URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($db, trim($_GET['id']));

    // query untuk menghapus data berdasarkan ID
    $query = "DELETE FROM buku WHERE id='$id'";
    $delete = mysqli_query($db, $query);

    if ($delete) {
        // jika berhasil, alihkan ke halaman dengan pesan berhasil
        header("Location: index.php?alert=3");
    } else {
        // jika gagal, tampilkan pesan error
        echo 'Query Error: ' . mysqli_error($db);
    }
} else {
    echo "ID tidak ditemukan.";
}

// tutup koneksi
mysqli_close($db);
?>
