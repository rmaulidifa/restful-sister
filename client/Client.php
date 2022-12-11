<?php
error_reporting(1);
class Client
{   private $url;

    public function __construct($url)
    {
        $this->url=$url;
        unset($url);
    }

    public function filter($data){
        $data = preg_replace('/[^a-zA-Z0-9]/','',$data);
        return $data;
        unset($data);
    }

    public function tampil_semua_data()
    {
        $client = curl_init($this->url);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;
        unset($data,$client,$response);
    }

    public function tampil_obat($id_obat){
        $id_obat = $this->filter($id_obat);
        $client = curl_init($this->url."?aksi=tampil&id_obat=".$id_obat);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;
        unset($id_obat,$client,$response,$data);
    }

    public function tampil_pasien($id_pasien){
        $id_pasien = $this->filter($id_pasien);
        $client = curl_init($this->url."?aksi=tampil&id_pasien=".$id_pasien);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;
        unset($id_pasien,$client,$response,$data);
    }

    public function tambah_obat($data){
        $data = '{
            "id_obat" : "'.$data['id_obat'].'",
            "nama_obat" : "'.$data['nama_obat'].'",
            "stok_obat" : "'.$data['stok_obat'].'",
            "harga_obat" : "'.$data['harga_obat'].'",
            "aksi" : "'.$data['aksi'].'"
        }';
        $c = curl_init();
        curl_setopt($c,CURLOPT_URL,$this->url);
        curl_setopt($c,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c,CURLOPT_POST,true);
        curl_setopt($c,CURLOPT_POSTFIELDS,$data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data,$c,$response);
    }

    public function tambah_pasien($data){
        $data = '{
            "id_pasien" : "'.$data['id_pasien'].'",
            "id_obat" : "'.$data['id_obat'].'",
            "nama_pasien" : "'.$data['nama_pasien'].'",
            "aksi" : "'.$data['aksi'].'"
        }';
        $c = curl_init();
        curl_setopt($c,CURLOPT_URL,$this->url);
        curl_setopt($c,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c,CURLOPT_POST,true);
        curl_setopt($c,CURLOPT_POSTFIELDS,$data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data,$c,$response);
    }

    public function ubah_obat($data)
    {
        $data = '{
            "id_obat" : "'.$data['id_obat'].'",
            "nama_obat" : "'.$data['nama_obat'].'",
            "stok_obat" : "'.$data['stok_obat'].'",
            "harga_obat" : "'.$data['harga_obat'].'",
            "aksi" : "'.$data['aksi'].'"
        }';
        $c = curl_init();
        curl_setopt($c,CURLOPT_URL,$this->url);
        curl_setopt($c,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c,CURLOPT_POST,true);
        curl_setopt($c,CURLOPT_POSTFIELDS,$data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data,$c,$response);
    }

    public function ubah_pasien($data)
    {
        $data = '{
            "id_pasien" : "'.$data['id_pasien'].'",
            "id_obat" : "'.$data['id_obat'].'",
            "nama_pasien" : "'.$data['nama_pasien'].'",
            "aksi" : "'.$data['aksi'].'"
        }';
        $c = curl_init();
        curl_setopt($c,CURLOPT_URL,$this->url);
        curl_setopt($c,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c,CURLOPT_POST,true);
        curl_setopt($c,CURLOPT_POSTFIELDS,$data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data,$c,$response);
    }

    public function hapus_obat($data){
        $id_obat = $this->filter($data['id_obat']);
        $data = '{
            "id_obat" : "'.$id_obat.'",
            "aksi" : "'.$data['aksi'].'"
        }';
        $c = curl_init();
        curl_setopt($c,CURLOPT_URL,$this->url);
        curl_setopt($c,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c,CURLOPT_POST,true);
        curl_setopt($c,CURLOPT_POSTFIELDS,$data);
        $response = curl_exec($c);
        curl_close($c);
        unset($id_obat,$data,$c,$response);
    }

    public function hapus_pasien($data){
        $id_pasien = $this->filter($data['id_pasien']);
        $data = '{
            "id_pasien" : "'.$id_pasien.'",
            "aksi" : "'.$data['aksi'].'"
        }';
        $c = curl_init();
        curl_setopt($c,CURLOPT_URL,$this->url);
        curl_setopt($c,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c,CURLOPT_POST,true);
        curl_setopt($c,CURLOPT_POSTFIELDS,$data);
        $response = curl_exec($c);
        curl_close($c);
        unset($id_pasien,$data,$c,$response);
    }

    public function __destruct(){
        unset($this->url);
    }
}
$url = 'http://192.168.156.203/restful-uas/server/server.php';
$abc = new Client($url);
?>