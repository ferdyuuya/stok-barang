<?php

// //Menghapus Barang Masuk    
//     if(isset($_POST['hapusbarangmasuk'])){
//         $idb = $_POST['idb'];
//         $qty = $_POST['qty'];
//         $idm = $_POST['idm'];

//         $getdatastok = mysqli_query($conn,"SELECT* from stok where idbarang='$idb'");
//         $data = mysqli_fetch_array($getdatastok);
//         $stok = $data['stock'];

//         $selisih = $stok-$qty;

//         $updatehapus = mysqli_query($conn,"UPDATE stok set stock='$selisih' where idbarang='$idb'");
//         $hapusdata = mysqli_query($conn,"DELETE * from masuk where idmasuk ='$idm'");

//         if($hitung&&$updatehapus&&$hapusdata){
//             header('location:masuk.php');
//                 } else {
//             header('location:masuk.php');
//     };
//     }


//     //Menghapus Barang Masuk    
//     if(isset($_POST['hapusbarangmasuk'])){

        
//         $idb = $_POST['idb'];
//         $idm = $_POST['idm'];

//         $getdatastok = mysqli_query($conn,"SELECT * from stok where idbarang='$idb'");
//         $getdataqty = mysqli_query($conn,"SELECT * from masuk where idmasuk='$idm'");

//         $data = mysqli_fetch_array($getdatastok);
//         $dataqty = mysqli_fetch_array($getdataqty);
        
//         $stok = $data['stock'];
//         $qty = $dataqty['qty'];

//         $selisih = $stok-$qty;

//         $updatehapus = mysqli_query($conn,"UPDATE stok set stock='$selisih' where idbarang='$idb'");
//         $hapusdata = mysqli_query($conn,"DELETE * from masuk where idmasuk ='$idm'");
        
//         if($updatehapus&&$hapusdata){
//             header('location:masuk.php');
//         } else {
//             header('location:masuk.php');
//         }
//     }
?>
