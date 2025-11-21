<?php

include_once(__DIR__ . "/KontrakPresenterSirkuit.php");
include_once(__DIR__ . "/../models/TabelSirkuit.php");
include_once(__DIR__ . "/../models/Sirkuit.php");
include_once(__DIR__ . "/../views/ViewSirkuit.php");

class PresenterSirkuit implements KontrakPresenterSirkuit
{
    private $tabelSirkuit; 
    private $viewSirkuit; 
    private $listSirkuit = []; 

    public function __construct($tabelSirkuit, $viewSirkuit)
    {
        $this->tabelSirkuit = $tabelSirkuit;
        $this->viewSirkuit = $viewSirkuit;
        $this->initListSirkuit();
    }

    //mengambil data dari database untuk membentuk objek sirkuit
    public function initListSirkuit()
    {
        $data = $this->tabelSirkuit->getAllSirkuit();
        $this->listSirkuit = [];
        foreach ($data as $item){
            $sirkuit = new Sirkuit(
                $item['id'],
                $item['nama'],
                $item['lokasi'],
                $item['kapasitas_penonton'],
                $item['rekor_pembalap'],
                $item['rekor_waktu']
            );
            $this->listSirkuit[] = $sirkuit;
        }
    }

    //menampilkan sirkuit ke view
    public function tampilkanSirkuit(): string
    {
       return $this->viewSirkuit->tampilSirkuit($this->listSirkuit);
    }

    //Menampilkan Form tambah atau edit 
    public function tampilkanFormSirkuit($id = null): string
    {
        $data = null;
        if($id !== null){
            $data = $this->tabelSirkuit->getSirkuitById($id);
        }
        return $this->viewSirkuit->tampilFormSirkuit($data);
    }

    // Implementasi metode CRUD

    //menambah sirkuit baru
    public function tambahSirkuit($nama, $lokasi, $kapasitas_penonton, $rekor_pembalap, $rekor_waktu): void 
    {
        $sirkuit = new Sirkuit(null, $nama, $lokasi, $kapasitas_penonton, $rekor_pembalap, $rekor_waktu);
        //simpan ke database dan ambil id barunya
        $idBaru = $this->tabelSirkuit->insertSirkuit($sirkuit);
        $sirkuit->setId($idBaru);
        //tambahkan ke list lokal
        $this->listSirkuit[] = $sirkuit;
    }

    //mengubah data sirkuit
    public function ubahSirkuit($id, $nama, $lokasi, $kapasitas_penonton, $rekor_pembalap, $rekor_waktu): void 
    {
        $sirkuit = new Sirkuit($id, $nama, $lokasi, $kapasitas_penonton, $rekor_pembalap, $rekor_waktu);
        //update database
        $this->tabelSirkuit->updateSirkuit($id, $nama, $lokasi, $kapasitas_penonton, $rekor_pembalap, $rekor_waktu);

        //update list lokal 
        foreach ($this->listSirkuit as $index => $s) {
            if ($s->getId() == $id) {
                $this->listSirkuit[$index] = $sirkuit;
                break;
            }
        }
    }

    //menghapus data  sirkuit
    public function hapusSirkuit($id): void 
    {
        //hapus dari database 
        $this->tabelSirkuit->deleteSirkuit($id);

        //hapus dari lokal 
        foreach ($this->listSirkuit as $index => $s) {
            if ($s->getId() == $id) {
                unset($this->listSirkuit[$index]);
                $this->listSirkuit = array_values($this->listSirkuit);
                break;
            }
        }
    }
}

?>