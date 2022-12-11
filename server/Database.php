<?php
error_reporting(1);

class Database{
    private $host ="localhost";
    private $dbname ="apoteku";
    private $user ="root";
    private $password ="";
    private $port ="3306";
    private $conn;

    public function __construct(){
        try{
            $this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname;charset=utf8", $this->user,$this->password);
            
        }
        catch(PDOException $e){
            echo "koneksi gagal";
        }
    }

    public function tampil_obat($id_obat)
    {
        $query = $this->conn->prepare("SELECT id_obat, nama_obat, stok_obat, harga_obat from obat where id_obat=?");
        $query->execute(array($id_obat));

        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data;

        $query->closeCursor();
        unset($id_obat, $data);
    }

    public function tampil_pasien($id_pasien)
    {
        $query = $this->conn->prepare("SELECT id_pasien, id_obat, nama_pasien from pasien where id_pasien=?");
        $query->execute(array($id_pasien));

        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data;

        $query->closeCursor();
        unset($id_pasien, $data);
    }

    public function tampil_semua_data()
    {
        $query = $this->conn->prepare("SELECT id_pasien, nama_obat, harga_obat, nama_pasien FROM obat INNER JOIN pasien ON obat.id_obat = pasien.id_obat order by id_pasien");
        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        return $data;

        $query->closeCursor();
        unset($data);
    }

    public function tambah_obat($data)
    {
        $query = $this->conn->prepare("insert ignore into obat (id_obat, nama_obat, stok_obat,  harga_obat) values (?,?,?,?)");
        $query->execute(array($data['id_obat'],$data['nama_obat'],$data['stok_obat'],$data['harga_obat']));

        $query->closeCursor();
        unset($data);
    }

    public function tambah_pasien($data)
    {
        $query = $this->conn->prepare("insert ignore into pasien (id_pasien, id_obat, nama_pasien) values (?,?,?)");
        $query->execute(array($data['id_pasien'],$data['id_obat'],$data['nama_pasien']));

        $query->closeCursor();
        unset($data);
    }

    public function ubah($data)
    {
        $query = $this->conn->prepare("update pasien set nama_pasien=?, nama_obat=?, harga_obat=? where id_pasien=?");
        $query->execute(array($data['nama_pasien'], $data['nama_obat'],$data['harga_obat'],$data['id_pasien']));

        $query->closeCursor();
        unset($data);
    }

    public function ubah_obat($data)
    {
        $query = $this->conn->prepare("update obat set nama_obat=?, stok_obat=?, harga_obat=? where id_obat=?");
        $query->execute(array($data['nama_obat'], $data['stok_obat'],$data['harga_obat'],$data['id_obat']));

        $query->closeCursor();
        unset($data);
    }

    public function ubah_pasien($data)
    {
        $query = $this->conn->prepare("update pasien set nama_pasien=?, id_obat=? where id_pasien=?");
        $query->execute(array($data['id_obat'],$data['nama_pasien'], $data['id_pasien']));

        $query->closeCursor();
        unset($data);
    }

    public function hapus($id_pasien)
    {
        $query = $this->conn->prepare("delete from pasien where id_pasien=?");
        $query->execute(array($id_pasien));

        $query->closeCursor();
        unset($id_pasien);
    }

    public function hapus_obat($id_obat)
    {
        $query = $this->conn->prepare("delete from obat where id_obat=?");
        $query->execute(array($id_obat));

        $query->closeCursor();
        unset($id_obat);
    }

    public function hapus_pasien($id_pasien)
    {
        $query = $this->conn->prepare("delete from pasien where id_pasien=?");
        $query->execute(array($id_pasien));

        $query->closeCursor();
        unset($id_pasien);
    }
}
?>