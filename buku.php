<div class="page-inner">
    <?php
    // fungsi untuk menampilkan pesan
    if (empty($_GET['alert'])) {
        echo "";
    } elseif ($_GET['alert'] == 1) { ?>
        <div>
            <div class="alert alert-success">
                Data buku berhasil disimpan.
            </div>
        </div>
    <?php
    } elseif ($_GET['alert'] == 2) { ?>
        <div>
            <div class="alert alert-success">
                Data buku berhasil diubah.
            </div>
        </div>
    <?php
    } elseif ($_GET['alert'] == 3) { ?>
        <div>
            <div class="alert alert-success">
                Data buku berhasil dihapus.
            </div>
        </div>
    <?php
    } elseif ($_GET['alert'] == 4) { ?>
        <div>
            <div class="alert alert-danger">
                Gagal menyimpan data
            </div>
        </div>
    <?php
    }
    ?>

    <div class="page-header">
        <h3 class="fw-bold mb-3">DataTables.Net</h3>
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
                <a href="#">Tables</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Datatables</a>
            </li>
        </ul>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Add Row</h4>
                    <a href="?page=tambah" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i>
                        Add Row
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Foto</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>Foto</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $query = mysqli_query($db, "SELECT * FROM buku")
                                or die('Ada kesalahan pada query buku: ' . mysqli_error($db));

                            if (isset($_POST['cari'])) {
                                $cari = mysqli_real_escape_string($db, trim($_POST['cari']));
                                $query = mysqli_query($db, "SELECT * FROM buku WHERE nama LIKE '%$cari%'");
                            }

                            while ($data = mysqli_fetch_assoc($query)) { ?>
                                <tr>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><img class="foto-thumbnail" src='foto/<?php echo $data['foto']; ?>' alt="Foto buku" width="110"></td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="?page=edit&id=<?php echo $data['id']; ?>" class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="hapus.php?id=<?php echo $data['id']; ?>" class="btn btn-link btn-danger" data-bs-toggle="tooltip" title="Delete" onclick="if (confirm('Apakah Anda yakin ingin menghapus data ini?')) window.location.href='hapus.php?id=<?php echo $data['id']; ?>'">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
