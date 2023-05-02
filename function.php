<?php

session_start();

$conn = mysqli_connect("localhost", "root","", "stokbarang");

if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];

    $addtotable = mysqli_query($conn, "INSERT INTO stok (namabarang, deskripsi, stok) VALUE ('$namabarang' , '$deskripsi', '$stok')");
    if($addketable){
        header('location:index.php');
    } else {
        echo 'gagal';
        header('location:index.php');
    }
}

if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "SELECT * FROM stok WHERE idbarang = '$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildatanya['stok'];
    $tambahkanstoksekarangdenganquantity = $stoksekarang + $qty;

    $addtomasuk = mysqli_query($conn, "INSERT INTO barangmasuk (idbarang, keterangan, qty) VALUE ('$barangnya', '$penerima', '$qty')");
    $updatestokmasuk = mysqli_query($conn, "UPDATE stok SET stok = '$tambahkanstoksekarangdenganquantity' WHERE idbarang = '$barangnya'");
    if($addtomasuk&&$updatestokmasuk){
        header('location:masuk.php');
    } else {
        echo 'gagal';
        header('location:masuk.php');
    }
}

if(isset($_POST['addnewbarangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "SELECT * FROM stok WHERE idbarang = '$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildatanya['stok'];
    $tambahkanstoksekarangdenganquantity = $stoksekarang - $qty;

    $addtokeluar = mysqli_query($conn, "INSERT INTO barangkeluar (idbarang, penerima, qty) VALUE ('$barangnya', '$penerima', '$qty')");
    $updatestokmasuk = mysqli_query($conn, "UPDATE stok SET stok = '$tambahkanstoksekarangdenganquantity' WHERE idbarang = '$barangnya'");
    if($addtokeluar&&$updatestokmasuk){
        header('location:keluar.php');
    } else {
        echo 'gagal';
        header('location:keluar.php');
    }
}

if(isset($_POST['updatebarang'])){
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];

    $update = mysqli_query($conn, "UPDATE stok SET namabarang = '$namabarang', deskripsi = '$deskripsi' WHERE idbarang = '$idb'");
    if($update){
        header('location:index.php');
    } else {
        echo 'gagal';
        header('location:index.php');
    } 
}

if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idb'];

    $hapus = mysqli_query($conn, "DELETE FROM stok WHERE idbarang = '$idb'");
    if($hapus){
        header('location:index.php');
    } else {
        echo 'gagal';
        header('location:index.php');
    } 
}
?>