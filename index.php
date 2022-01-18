<?php

require 'function.php';
require 'cek.php';

$id = $_SESSION["iduser"];
// var_dump($id);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Stok Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Stok Barang</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

        <!-- Navbar-->
        </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stok Barang
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="keluar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Barang Keluar
                        </a>
                        <a class="nav-link" href="logout.php">
                            Logout
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php
                    $ambilnamauser = mysqli_query($conn, "SELECT * FROM login WHERE iduser = $id");
                    while ($data = mysqli_fetch_array($ambilnamauser)) {
                        $email = $data['email'];
                        $nama_user = $data['nama_user'];
                    }
                    ?>
                    <h6 style="font-size: 15px"><?= $nama_user; ?></h6>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Stok Barang</h1>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Tambah Barang
                            </button>
                            <a href="export.php" class="btn btn-info" style="color:white">Export Data</a>
                        </div>
                        <div class="card-body">
                            <?php
                            $ambildatastok = mysqli_query($conn, "SELECT  * from stok where stock < 1");
                            while ($fetch = mysqli_fetch_array($ambildatastok)) {
                                $barang = $fetch['nama_barang'];
                            ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    <strong>Danger!</strong> Stock Barang <b><?= $barang; ?></b> telah habis.
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                            $ambildatastok2 = mysqli_query($conn, "SELECT  * from stok where stock < 10 and stock > 1");
                            while ($fetch = mysqli_fetch_array($ambildatastok2)) {
                                $barang2 = $fetch['nama_barang'];
                            ?>
                                <div class="alert alert-warning alert-dismissible">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    <strong>Danger!</strong> Stock Barang <b><?= $barang2; ?></b> kurang dari 10 buah.
                                </div>
                            <?php
                            }
                            ?>
                            <table id="datatablesSimple">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Merek Barang</th>
                                        <th>Kategori</th>
                                        <th>Stok</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ambilsemuadatastok = mysqli_query($conn, "SELECT * FROM stok");
                                    $i = 1;
                                    while ($data = mysqli_fetch_array($ambilsemuadatastok)) {
                                        $nama_barang = $data['nama_barang'];
                                        $deskripsi = $data['deskripsi'];
                                        $merek_barang = $data['merek_barang'];
                                        $stock = $data['stock'];
                                        $idb = $data['idbarang'];

                                        echo '<tr>';
                                        echo '<td>' . $i++ . '</td>';
                                        echo '<td>' . $nama_barang . '</td>';
                                        echo '<td>' . $merek_barang . '</td>';
                                        echo '<td>' . $deskripsi . '</td>';
                                        echo '<td>' . $stock . '</td>';
                                        echo '<td>';
                                        // <!-- Button trigger modal -->
                                        echo '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit' . $idb . '">
                                                    Edit';
                                        echo '</button>';
                                        // <!-- Button trigger modal -->
                                        echo '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete' . $idb . '">
                                                    Delete';
                                        echo '</button>';
                                        echo '</td>';
                                        echo '</tr>';
                                    ?>
                                        <!--  Edit Modal -->
                                        <div>


                                            <div class="modal fade" id="edit<?= $idb; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Edit Barang</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <!-- Edit Modal Body -->

                                                        <form method="post">
                                                            <div class="modal-body" id="edit<?= $idb; ?>">

                                                                <input type="text" name="nama_barang" value="<?= $nama_barang; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="deskripsi" value="<?= $deskripsi; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="merek_barang" value="<?= $merek_barang; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                                <button type="submit" class="btn btn-primary" name="updatebarang">Submit</button>
                                                            </div>
                                                        </form>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--  Delete Modal -->
                                            <div class="modal fade" id="delete<?= $idb; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Hapus Barang</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <!-- Delete Modal Body -->

                                                        <form method="post">
                                                            <div class="modal-body" id="delete<?= $idb; ?>">
                                                                Apakah anda yakin ingin menghapus <?= $nama_barang; ?>?
                                                                <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                                <input type="hidden" name="idm" value="<?= $idm; ?>">
                                                                <br>
                                                                <br>
                                                                <button type="submit" class="btn btn-danger" name="hapusbarang">Hapus</button>
                                                            </div>
                                                        </form>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    };
                                        ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Launch static backdrop modal
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->

            <form method="post">
                <div class="modal-body">

                    <input type="text" name="nama_barang" placeholder="Nama Barang" class="form-control" required>
                    <br>
                    <input type="text" name="deskripsi" placeholder="Deskripsi" class="form-control" required>
                    <br>
                    <input type="text" name="merek_barang" placeholder="Merek Barang" class="form-control" required>
                    <br>
                    <input type="number" name="stok" placeholder="Jumlah Barang" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>

                </div>

            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

</html>