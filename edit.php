<?php
// panggil file database.php untuk koneksi ke database
require_once "config/koneksi.php";

// inisialisasi variabel
$id = '';
$nama = '';
$foto = '';

// jika parameter id ada di URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($db, trim($_GET['id']));
    // query untuk mengambil data berdasarkan id
    $query = mysqli_query($db, "SELECT * FROM buku WHERE id='$id'")
        or die('Query Error: ' . mysqli_error($db));
    
    $data = mysqli_fetch_assoc($query);

    // pastikan data ada
    if ($data) {
        $nama = $data['nama'];
        $foto = $data['foto'];
    } else {
        // handle case jika data tidak ditemukan
        echo "Data buku tidak ditemukan.";
        exit;
    }
} else {
    echo "Parameter ID tidak ditemukan.";
    exit;
}
?>


<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Edit Buku</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Edit</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Edit Buku</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Buku</div>
                </div>
                <form class="card-body" action="ubah.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>" />
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="nama"
                                    value="<?php echo htmlspecialchars($nama); ?>"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="foto"
                                />
                                <?php if ($foto): ?>
                                    <img src="foto/<?php echo htmlspecialchars($foto); ?>" alt="Foto Buku" width="100" />
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button class="btn btn-success" name="simpan">Update</button>
                        <button class="btn btn-danger" type="reset">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


