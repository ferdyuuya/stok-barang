<?php
session_start();

//Membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "stokbarang");

// Check Connection
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

//Menambah barang baru
if (isset($_POST['addnewbarang'])) {
    $nama_barang = $_POST['nama_barang'];
    $deskripsi = $_POST['deskripsi'];
    $merek_barang = $_POST['merek_barang'];
    $stok = $_POST['stok'];

    $addtotable = mysqli_query($conn, "INSERT INTO stok (nama_barang,deskripsi,stock,merek_barang) 
        VALUES ('$nama_barang', '$deskripsi', '$stok', '$merek_barang')");
    if ($addtotable) {
        echo 'Berhasil';
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

// Menambah barang masuk
if (isset($_POST['barang_masuk'])) {
    $barangnya = $_POST['barangnya'];
    $pengirim = $_POST['pengirim'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stok where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstoksekarangdenganquantity = $stocksekarang + $qty;

    $addtomasuk = mysqli_query($conn, "INSERT INTO masuk (idbarang, pengirim, qty) values ('$barangnya','$pengirim','$qty')");
    $updatestokmasuk = mysqli_query($conn, "UPDATE stok set stock ='$tambahkanstoksekarangdenganquantity' where idbarang= '$barangnya'");
    if ($addtomasuk && $updatestokmasuk) {
        header('location:masuk.php');
    } else {
        echo 'Gagal';
        header('location:masuk.php');
    }
}

//Menambah barang keluar
if (isset($_POST['barang_keluar'])) {
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stok where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];

    if ($stocksekarang >= $qty) {
        //kalau barangnya cukup
        $kurangkanstoksekarangdenganquantity = $stocksekarang - $qty;

        $addtokeluar = mysqli_query($conn, "INSERT INTO keluar (idbarang, penerima, qty) values ('$barangnya','$penerima','$qty')");
        $updatestokkeluar = mysqli_query($conn, "UPDATE stok set stock ='$kurangkanstoksekarangdenganquantity' where idbarang= '$barangnya'");
        if ($addtokeluar && $updatestokmasuk) {
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        }
    } else {
        //Kalau Barangnya tidak cukup
        echo '
        <script>
            alert("Stock saat ini tidak mencukupi");
            window.location.href="keluar.php";
        </script>
        ';
    }
}

//Update Barang
if (isset($_POST['updatebarang'])) {
    $idb = $_POST['idb'];
    $nama_barang = $_POST['nama_barang'];
    $deskripsi = $_POST['deskripsi'];
    $merek_barang = $_POST['merek_barang'];

    $update = mysqli_query($conn, "UPDATE stok set nama_barang ='$nama_barang', deskripsi = '$deskripsi', merek_barang = '$merek_barang' where idbarang = '$idb'");
    if ($update) {
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

//Delete Barang
if (isset($_POST['hapusbarang'])) {
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];

    $delete = mysqli_query($conn, "DELETE from stok where idbarang = '$idb'");
    if ($delete) {
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

//Update Edit Barang Masuk
if (isset($_POST['updatebarangmasuk'])) {
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $pengirim = $_POST['pengirim'];
    $qty = $_POST['qty'];

    //Liat stok sekarang
    $lihatstock = mysqli_query($conn, "SELECT * from stok where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrng = $stocknya['stock'];

    //liat stok sekarang keluar
    $qtyskrng = mysqli_query($conn, "SELECT * from masuk where idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtyskrng);
    $qtyskrng = $qtynya['qty'];


    if ($qty > $qtysekarang) {
        $selisih = $qty - $qtyskrng;
        $kurang = $stockskrng + $selisih;
        $kurangistock = mysqli_query($conn, "UPDATE stok set stock='$kurang' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "UPDATE masuk set qty='$qty', pengirim='$pengirim' where idmasuk='$idm'");
        if ($kurangistock && $updatenya) {
            header('location:masuk.php');
        } else {
            echo 'Gagal';
            header('location:masuk.php');
        }
    } else {
        $selisih = $qtyskrng - $qty;
        $kurang = $stockskrng - $selisih;
        $kurangistock = mysqli_query($conn, "UPDATE stok set stock='$kurang' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "UPDATE masuk set qty='$qty', pengirim='$pengirim' where idmasuk='$idm'");
        if ($kurangistock && $updatenya) {
            header('location:masuk.php');
        } else {
            echo 'Gagal';
            header('location:masuk.php');
        }
    }
}

//Menghapus Barang Masuk    
if (isset($_POST['hapusbarangmasuk'])) {
    $idb = $_POST['idb'];
    $kty = $_POST['kty'];
    $idm = $_POST['idm'];

    $getdatastok = mysqli_query($conn, "SELECT* from stok where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastok);
    $stok = $data['stock'];

    $hitung = mysqli_num_rows($getdatastok);

    $selisih = $stok - $kty;

    $updatehapus = mysqli_query($conn, "UPDATE stok set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "DELETE FROM `masuk` WHERE `masuk`.`idmasuk`=$idm");

    if ($hitung > 0) {
        $_SESSION['log'] = 'True';
        $row = mysqli_fetch_assoc($getdatastok);
        if ($updatehapus && $hapusdata) {
            header('location:masuk.php');
        } else {
            header('location:masuk.php');
        }
        header('location:masuk.php');
    } else {
        header('location:masuk.php');
    };
}







//Update Edit Barang Keluar
if (isset($_POST['updatebarangkeluar'])) {
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    //Liat stok sekarang
    $lihatstock = mysqli_query($conn, "SELECT * from stok where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrng = $stocknya['stock'];

    //liat stok sekarang keluar
    $qtyskrng = mysqli_query($conn, "SELECT * from keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrng);
    $qtyskrng = $qtynya['qty'];


    if ($qty > $qtysekarang) {
        $selisih = $qty - $qtyskrng;
        $kurang = $stockskrng - $selisih;
        $kurangistock = mysqli_query($conn, "UPDATE stok set stock='$kurang' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "UPDATE keluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'");
        if ($kurangistock && $updatenya) {
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        }
    } else {
        $selisih = $qtyskrng - $qty;
        $kurang = $stockskrng + $selisih;
        $kurangistock = mysqli_query($conn, "UPDATE stok set stock='$kurang' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "UPDATE keluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'");
        if ($kurangistock && $updatenya) {
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        }
    }
}

//Menghapus Barang keluar   
if (isset($_POST['hapusbarangkeluar'])) {
    $idb = $_POST['idb'];
    $kty = $_POST['kty'];
    $idk = $_POST['idk'];

    $getdatastok = mysqli_query($conn, "SELECT* from stok where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastok);
    $stok = $data['stock'];

    $hitung = mysqli_num_rows($getdatastok);

    $selisih = $stok + $kty;

    $updatehapus = mysqli_query($conn, "UPDATE stok set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "DELETE FROM `keluar` WHERE `keluar`.`idkeluar`='$idk'");

    if ($hitung > 0) {
        $_SESSION['log'] = 'True';
        $row = mysqli_fetch_assoc($getdatastok);
        if ($updatehapus && $hapusdata) {
            header('location:keluar.php');
        } else {
            header('location:keluar.php');
        }
        header('location:keluar.php');
    } else {
        header('location:keluar.php');
    };
}
