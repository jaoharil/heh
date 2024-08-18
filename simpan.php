<?php
// panggil file database.php untuk koneksi ke database
require_once "config/koneksi.php";

// jika tombol simpan diklik
if (isset($_POST['simpan'])) {
    // ambil data hasil submit dari form
    $nama = mysqli_real_escape_string($db, trim($_POST['nama']));
    $deskripsi = mysqli_real_escape_string($db, trim($_POST['deskripsi']));
    $tmp_file = $_FILES['foto']['tmp_name'];
    $nama_file = $_FILES['foto']['name'];
    $path = "foto/" . $nama_file;

    // Cek apakah file berhasil diupload
    if (move_uploaded_file($tmp_file, $path)) {
        // jika file berhasil diupload, simpan data ke database
        $insert = mysqli_query($db, "INSERT INTO buku(nama, deskripsi, foto) VALUES('$nama','$deskripsi', '$nama_file')")
            or die('Ada kesalahan pada query insert: ' . mysqli_error($db));
        
        // cek apakah data berhasil disimpan
        if ($insert) {
            // jika berhasil tampilkan pesan berhasil simpan data
            header("location: index.php?alert=1");
        } else {
            // jika gagal simpan data, tampilkan pesan gagal
            echo "Gagal menyimpan data: " . mysqli_error($db);
        }
    } else {
        // jika gagal upload file, tampilkan pesan gagal
        echo "Gagal mengupload file.";
    }
}

// tutup koneksi
mysqli_close($db);
?>
