<?php

class Sirkuit {
    private $id;
    private $nama;
    private $lokasi;
    private $panjang;
    private $kapasitas_penonton;
    private $rekor_pembalap;
    private $rekor_waktu;

    //contructor to initialize sirkuit
    public function __construct($id, $nama, $lokasi, $kapasitas_penonton, $rekor_pembalap, $rekor_waktu) {
        $this->id = $id;
        $this->nama = $nama;
        $this->lokasi = $lokasi;
        $this->kapasitas_penonton = $kapasitas_penonton;
        $this->rekor_pembalap = $rekor_pembalap;
        $this->rekor_waktu = $rekor_waktu;
    }

    // Getter methods
    public function getId() { return $this->id; }
    public function getNama() { return $this->nama; }
    public function getLokasi() { return $this->lokasi; }
    public function getKapasitasPenonton() { return $this->kapasitas_penonton; }
    public function getRekorPembalap() { return $this->rekor_pembalap; }
    public function getRekorWaktu() { return $this->rekor_waktu; }

    // Setter methods
    public function setId($id) { $this->id = $id; }
    public function setNama($nama) { $this->nama = $nama; }
    public function setLokasi($lokasi) { $this->lokasi = $lokasi; }
    public function setKapasitasPenonton($kapasitas_penonton) { $this->kapasitas_penonton = $kapasitas_penonton; }
    public function setRekorPembalap($rekor_pembalap) { $this->rekor_pembalap = $rekor_pembalap; }
    public function setRekorWaktu($rekor_waktu) { $this->rekor_waktu = $rekor_waktu; }
}

?>