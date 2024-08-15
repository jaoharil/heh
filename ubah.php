<?php
// panggil file database.php untuk koneksi ke database
require_once "config/koneksi.php";

// ambil data dari form
if (isset($_POST['simpan'])) {
    $id = mysqli_real_escape_string($db, trim($_POST['id']));
    $nama = mysqli_real_escape_string($db, trim($_POST['nama']));
    $tmp_file = $_FILES['foto']['tmp_name'];
    $nama_file = $_FILES['foto']['name'];
    $path = "foto/" . $nama_file;

    // Jika ada file yang diupload, lakukan proses upload
    if ($nama_file) {
        if (move_uploaded_file($tmp_file, $path)) {
            // jika file berhasil diupload, update data ke database
            $query = "UPDATE buku SET nama='$nama', foto='$nama_file' WHERE id='$id'";
        } else {
            echo "Gagal mengupload file.";
            exit;
        }
    } else {
        // jika tidak ada file yang diupload, hanya update nama
        $query = "UPDATE buku SET nama='$nama' WHERE id='$id'";
    }

    // Eksekusi query
    $update = mysqli_query($db, $query);
    if (!$update) {
        // tampilkan pesan kesalahan jika query gagal
        echo 'Query Error: ' . mysqli_error($db);
        exit;
    }

    // cek apakah data berhasil diupdate
    if ($update) {
        // jika berhasil tampilkan pesan berhasil update data
        header("location: index.php?alert=2");
    } else {
        // jika gagal update data, tampilkan pesan gagal
        header("location: index.php?alert=4");
    }
}

// tutup koneksi
mysqli_close($db);
?>
