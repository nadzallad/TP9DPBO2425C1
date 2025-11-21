<?php

// Memuat class DB untuk koneksi & eksekusi query, serta kontrak interface model
include_once ("models/DB.php");
include_once ("KontrakModelSirkuit.php");

// Class TabelSirkuit mengatur semua operasi CRUD pada tabel "sirkuit"
class TabelSirkuit extends DB implements KontrakModelSirkuit {

    // Konstruktor: meneruskan konfigurasi database ke parent DB
    public function __construct($host, $db_name, $username, $password) {
        parent::__construct($host, $db_name, $username, $password);
    }

    // Mengambil semua data sirkuit (urutkan dari ID terbesar)
    public function getAllSirkuit(): array {
        $query = "SELECT * FROM sirkuit ORDER BY id DESC";

        // Eksekusi query tanpa parameter
        $this->executeQuery($query);

        // Ambil semua hasil dalam bentuk array asosiatif
        return $this->getAllResult();
    }

    // Mengambil satu data sirkuit berdasarkan ID
    public function getSirkuitById($id): ?array {

        // Eksekusi menggunakan prepared statement untuk keamanan
        $this->executeQuery("SELECT * FROM sirkuit WHERE id = :id", ['id'=> $id]);

        // Ambil seluruh hasil (biasanya hanya satu)
        $results = $this->getAllResult();

        // Kembalikan indeks pertama atau null jika tidak ada data
        return $results[0] ?? null;
    }

    // Menambahkan data sirkuit baru ke database
    public function addSirkuit($nama, $lokasi, $kapasitas_penonton, $rekor_pembalap, $rekor_waktu): void {
        
        // Query insert dengan parameter binding
        $query = "INSERT INTO sirkuit (nama, lokasi, kapasitas_penonton, rekor_pembalap, rekor_waktu) 
                  VALUES (:nama, :lokasi, :kapasitas_penonton, :rekor_pembalap, :rekor_waktu)";

        // Eksekusi query menggunakan array parameter
        $this->executeQuery($query, [
            'nama' => $nama,
            'lokasi' => $lokasi,
            'kapasitas_penonton' => $kapasitas_penonton,
            'rekor_pembalap' => $rekor_pembalap,
            'rekor_waktu' => $rekor_waktu
        ]);
    }
    
    // Mengupdate data sirkuit berdasarkan ID
    public function updateSirkuit($id, $nama, $lokasi, $kapasitas_penonton, $rekor_pembalap, $rekor_waktu): void {

        // Query update menggunakan parameter binding
        $query = "UPDATE sirkuit SET 
                  nama = :nama, 
                  lokasi = :lokasi, 
                  kapasitas_penonton = :kapasitas_penonton, 
                  rekor_pembalap = :rekor_pembalap, 
                  rekor_waktu = :rekor_waktu 
                  WHERE id = :id";

        // Eksekusi query update
        $this->executeQuery($query, [
            'id' => $id,
            'nama' => $nama,
            'lokasi' => $lokasi,
            'kapasitas_penonton' => $kapasitas_penonton,
            'rekor_pembalap' => $rekor_pembalap,
            'rekor_waktu' => $rekor_waktu
        ]);
    }
    
    // Menghapus data sirkuit berdasarkan ID
    public function deleteSirkuit($id): void {

        // Query delete
        $query = "DELETE FROM sirkuit WHERE id = :id";

        // Eksekusi penghapusan
        $this->executeQuery($query, ['id' => $id]);
    }

    // Insert versi objek Sirkuit, sekaligus mengembalikan ID terakhir
    public function insertSirkuit($sirkuit) {

        // Memanggil addSirkuit dengan getter dari objek
        $this->addSirkuit(
            $sirkuit->getNama(),
            $sirkuit->getLokasi(),
            $sirkuit->getKapasitasPenonton(),
            $sirkuit->getRekorPembalap(),
            $sirkuit->getRekorWaktu()
        );
        
        // LAST_INSERT_ID digunakan karena properti $conn bersifat private di DB
        $stmt = $this->executeQuery("SELECT LAST_INSERT_ID() as last_id");

        // Ambil hasil query
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kembalikan ID terakhir
        return $result['last_id'];
    }
}

?>
