<?php
    include "Client.php";

    if($_POST['aksi'] == 'tambahobat'){
        $data = array("id_obat"=>$_POST['id_obat'], 
        "nama_obat"=>$_POST['nama_obat'],
        "stok_obat"=>$_POST['stok_obat'],
        "harga_obat"=>$_POST['harga_obat'],
        "aksi"=>$_POST['aksi']);
        $abc->tambah_obat($data);
        header('location:index.php?page=tambahobat');

    } else if($_POST['aksi'] == 'tambahpasien'){
        $data = array("id_pasien"=>$_POST['id_pasien'], 
        "id_obat"=>$_POST['id_obat'],
        "nama_pasien"=>$_POST['nama_pasien'],
        "aksi"=>$_POST['aksi']);
        $abc->tambah_pasien($data);
        header('location:index.php?page=tambahpasien');

    }else if($_POST['aksi'] == 'ubah'){
        $data = array("id_pasien"=>$_POST['id_pasien'],
        "nama_pasien"=>$_POST['nama_pasien'],
        "nama_obat"=>$_POST['nama_obat'],
        "harga_obat"=>$_POST['harga_obat'],
        "aksi"=>$_POST['aksi']);
        $abc->ubah($data);
        header('location:index.php?page=daftar-data');

    }else if($_POST['aksi'] == 'ubahobat'){
        $data = array("id_obat"=>$_POST['id_obat'],
        "nama_obat"=>$_POST['nama_obat'],
        "stok_obat"=>$_POST['stok_obat'],
        "harga_obat"=>$_POST['harga_obat'],
        "aksi"=>$_POST['aksi']);
        $abc->ubah_obat($data);
        header('location:index.php?page=ubahobat');

    } else if($_POST['aksi'] == 'ubahpasien'){
        $data = array("id_pasien"=>$_POST['id_pasien'],
        "id_obat"=>$_POST['id_obat'],
        "nama_pasien"=>$_POST['nama_pasien'],
        "aksi"=>$_POST['aksi']);
        $abc->ubah_pasien($data);
        header('location:index.php?page=ubahpasien');

    }else if($_GET['aksi'] == 'hapus'){
        $data = array("id_pasien"=>$_GET['id_pasien'], "aksi"=>$_GET['aksi']);
        $abc->hapus($data);
        header('location:index.php?page=daftar-data');

    }else if($_GET['aksi'] == 'hapusobat'){
        $data = array("id_obat"=>$_GET['id_obat'], "aksi"=>$_GET['aksi']);
        $abc->hapus_obat($data);
        header('location:index.php?page=tambahobat');

    }else if($_GET['aksi'] == 'hapuspasien'){
        $data = array("id_pasien"=>$_GET['id_pasien'], "aksi"=>$_GET['aksi']);
        $abc->hapus_pasien($data);
        header('location:index.php?page=tambahpasien');
    }
    unset($abc, $data);
?>