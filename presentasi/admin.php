<?php
include 'components/koneksi.php';
session_start();

if (!isset($_SESSION['masuk'])) {
    header('location:index.php');
}
if ($_SESSION['role'] == 'Pimpinan') {
    header('location:user.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'components/head.php' ?>
    <title>Halaman Admin</title>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'components/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'components/topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Barang</h1>

                    <!-- Table -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><a href="add_data.php"><i class="fas fa-fw fa-plus"></i>Tambah Data</a></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Kategori</th>
                                            <th>Jumlah</th>
                                            <th>Pemasok</th>
                                            <th>Gambar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $result = mysqli_query($conn, "SELECT * FROM tb_data A, tb_kategori B, tb_pemasok C WHERE A.kategori_id=B.id_kategori AND A.pemasok_id=C.id_pemasok");
                                        while ($row = mysqli_fetch_assoc($result)) :
                                        ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row['kode_barang']; ?></td>
                                                <td><?= $row['nama_barang']; ?></td>
                                                <td><?= $row['kategori']; ?></td>
                                                <td><?= $row['jumlah']; ?></td>
                                                <td><?= $row['pemasok']; ?></td>
                                                <td>
                                                    <img src="uploaded/<?= $row['gambar']; ?>" width="100" height="100" style="background-position: center; object-fit: cover;">
                                                </td>
                                                <td>
                                                    <a href="edit.php?id_data=<?= $row['id_data']; ?>"><i class="fas fa-fw fa-edit"></i></a> -
                                                    <a href="proses/hapus.php?id_data=<?= $row['id_data']; ?>" onclick="return confirm('Yakin ingin hapus?')"><i class="fas fa-fw fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'components/footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php include 'components/scroll_top.php'; ?>

    <!-- Logout Notif-->
    <?php include 'components/logout_notif.php'; ?>

    <!-- Bootstrap core JavaScript-->
    <!-- Core plugin JavaScript-->
    <!-- Custom scripts for all pages-->
    <?php include 'components/script.php'; ?>
</body>

</html>