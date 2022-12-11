<?php
    error_reporting(1);
    include "Database.php";
    $abc = new Database();

    if(isset($_SERVER['HTTP_ORIGIN'])){
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Acess-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');
    }
    if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
        if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Acess-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']})");
        exit(0);
    }
    $postdata = file_get_contents("php://input");

    function filter($data)
    {
        $data = preg_replace('/[^a-zA-Z0-9]/', '', $data);
        return $data; 
        unset($data);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    { 
        
        $data = json_decode($postdata);
        $id_obat = $data->id_obat;
        $nama_obat = $data->nama_obat;
        $stok_obat = $data->stok_obat;
        $harga_obat = $data->harga_obat;
        $id_pasien = $data->id_pasien;
        $nama_pasien = $data->nama_pasien;
        $aksi = $data->aksi;
        // var_dump($data);
        // die();
        
        if ($aksi == 'tambahobat')
        {
            $data1 = array( 
                        'nama_obat' => $nama_obat,
                        'stok_obat' => $stok_obat, 
                        'harga_obat' => $harga_obat
                        );
        $abc->tambah_obat($data1); 

        } elseif ($aksi == 'tambahpasien')
        {
            $data2 = array('id_obat' => $id_obat, 
                        'nama_pasien' => $nama_pasien,
                        );
        $abc->tambah_pasien($data2);

        } elseif ($aksi == 'ubahobat'){
            
        $data1 = array('id_obat' => $id_obat, 
            'nama_obat' => $nama_obat, 
            'stok_obat' => $stok_obat,
            'harga_obat' => $harga_obat
        );
        $abc->ubah_obat($data1);

        } elseif ($aksi == 'ubahpasien')
        {   $data2 = array('id_pasien' => $id_pasien, 
                            'id_obat' => $id_obat, 
                            'nama_pasien' => $nama_pasien, 
                        );
            $abc->ubah_pasien($data2);
        }
        elseif ($aksi == 'hapus')
        { $abc->hapus_obat($id_obat); 

        } elseif ($aksi == 'hapus')
        { $abc->hapus_pasien($id_pasien); 
        }

    unset($postdata, $data, $data1, $data2, $id_obat, $nama_obat, $stok_obat, $harga_obat, $id_pasien, $nama_pasien, $aksi, $abc);
    }   elseif ($_SERVER['REQUEST_METHOD'] == 'GET')
    {   if (($_GET['aksi'] == 'tampilobat') and (isset($_GET['id_obat']))) 
        {
            $id_obat = filter($_GET['id_obat']);
            $data = $abc->tampil_obat($id_obat);
            echo json_encode($data);
        } elseif (($_GET['aksi'] == 'tampilpasien') and (isset($_GET['id_pasien']))) 
        {
            $id_pasien = filter($_GET['id_pasien']);
            $data = $abc->tampil_pasien($id_pasien);
            echo json_encode($data);
        } else 
        {   $data = $abc->tampil_semua_data();
            echo json_encode($data);
        } unset($postdata, $data, $id_obat, $id_pasien, $abc);
    }
?>