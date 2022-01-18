<?php

require 'function.php';
require 'cek.php';

$id = $_SESSION["iduser"];
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Barang Keluar</title>
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
                    <h1 class="mt-4">Barang Keluar</h1>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Tambah Barang Keluar
                            </button>
                            <a href="exportkeluar.php" class="btn btn-info" style="color:white">Export Data</a>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nama Barang</th>
                                        <th>Merek Barang</th>
                                        <th>Quantity</th>
                                        <th>Penerima</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ambilsemuadatastok = mysqli_query($conn, "SELECT * FROM keluar k, stok s where k.idbarang = s.idbarang");
                                    $i = 1;
                                    while ($data = mysqli_fetch_array($ambilsemuadatastok)) {
                                        $idb = $data['idbarang'];
                                        $idk = $data['idkeluar'];
                                        $keluar = $data['keluar'];
                                        $nama_barang = $data['nama_barang'];
                                        $merek_barang = $data['merek_barang'];
                                        $qty = $data['qty'];
                                        $penerima = $data['penerima'];

                                    ?>
                                        <tr>
                                            <td><?= $keluar; ?></td>
                                            <td><?= $nama_barang; ?></td>
                                            <td><?= $merek_barang; ?></td>
                                            <td><?= $qty; ?></td>
                                            <td><?= $penerima; ?></td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $idk; ?>">
                                                    Edit
                                                </button>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $idk; ?>">
                                                    Delete
                                                </button>
                                            </td>
                                            <div>
                                                <div class="modal fade" id="edit<?= $idk; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Barang</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <!-- Edit Modal Body -->
                                                            <form method="post">
                                                                <div class="modal-body" id="edit<?= $idk; ?>">
                                                                    <input type="number" name="qty" value="<?= $qty; ?>" class="form-control" required>
                                                                    <br>
                                                                    <input type="text" name="penerima" value="<?= $penerima; ?>" class="form-control" required>
                                                                    <br>
                                                                    <input type="hidden" name="idk" value="<?= $idk; ?>">
                                                                    <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                                    <button type="submit" class="btn btn-primary" name="updatebarangkeluar">Submit</button>
                                                                </div>
                                                            </form>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--  Delete Modal -->
                                                <div class="modal fade" id="delete<?= $idk; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Hapus Barang</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <!-- Delete Modal Body -->
                                                            <form method="post">
                                                                <div class="modal-body" id="delete<?= $idk; ?>">
                                                                    Apakah anda yakin ingin menghapus <?= $nama_barang; ?>
                                                                    <input type="hidden" name="idk" value="<?= $idk; ?>">
                                                                    <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                                    <input type="hidden" name="kty" value="<?= $qty; ?>">

                                                                    <br>
                                                                    <br>
                                                                    <button type="submit" class="btn btn-danger" name="hapusbarangkeluar">Hapus</button>
                                                                </div>
                                                            </form>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </tr>

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
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Launch static backdrop modal
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Barang Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->

            <form method="post">
                <div class="modal-body">
                    <select name="barangnya" class="form-control" required>
                        <?php
                        $ambilsemuadatanya = mysqli_query($conn, "SELECT * FROM stok");
                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                            $merekbarangnya =  $fetcharray['merek_barang'];
                            $idbarangnya =    $fetcharray['idbarang'];
                            $namabarangnya = $fetcharray['nama_barang'];
                        ?>
                            <option value="<?= $idbarangnya; ?>"><?= $namabarangnya; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <br>
                    <input type="number" name="qty" placeholder="Quantity" class="form-control" required>
                    <br>
                    <input type="text" name="penerima" placeholder="Penerima" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="barang_keluar">Submit</button>

                </div>

            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

</html>