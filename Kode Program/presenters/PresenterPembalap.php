<?php

include_once(__DIR__ . "/KontrakPresenter.php");
include_once(__DIR__ . "/../models/TabelPembalap.php");
include_once(__DIR__ . "/../models/Pembalap.php");
include_once(__DIR__ . "/../views/ViewPembalap.php");

class PresenterPembalap implements KontrakPresenter
{
    private $tabelPembalap; 
    private $viewPembalap; 
    private $listPembalap = []; 

    public function __construct($tabelPembalap, $viewPembalap)
    {
        $this->tabelPembalap = $tabelPembalap;
        $this->viewPembalap = $viewPembalap;
        $this->initListPembalap();
    }

    public function initListPembalap()
    {
        $data = $this->tabelPembalap->getAllPembalap();
        $this->listPembalap = [];
        foreach ($data as $item){
            $pembalap = new Pembalap(
                $item['id'],
                $item['nama'],
                $item['tim'],
                $item['negara'],
                $item['poinMusim'],
                $item['jumlahMenang']
            );
            $this->listPembalap[] = $pembalap;
        }
    }

    public function tampilkanPembalap(): string
    {
       return $this->viewPembalap->tampilPembalap($this->listPembalap);
    }

    public function tampilkanFormPembalap($id = null): string
    {
        $data = null;
        if($id !== null){
            $data = $this->tabelPembalap->getPembalapById($id);
        }
        return $this->viewPembalap->tampilFormPembalap($data);
    }

    // Implementasi metode CRUD

    public function tambahPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void 
    {
        // Buat objek Pembalap baru
        $pembalap = new Pembalap(null, $nama, $tim, $negara, $poinMusim, $jumlahMenang);

        // Simpan ke database melalui Model
        $idBaru = $this->tabelPembalap->insertPembalap($pembalap);

        // Update ID di objek
        $pembalap->setId($idBaru);
        // Tambahkan ke list lokal
        $this->listPembalap[] = $pembalap;
    }

    public function ubahPembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void 
    {
        // Buat objek Pembalap dengan data baru
        $pembalap = new Pembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang);

        // Update ke database
        $this->tabelPembalap->updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang);

        // Update list lokal
        foreach ($this->listPembalap as $index => $p) {
            if ($p->getId() == $id) {
                $this->listPembalap[$index] = $pembalap;
                break;
            }
        }
    }

    public function hapusPembalap($id): void 
    {
        // Hapus dari database
        $this->tabelPembalap->deletePembalap($id);

        // Hapus dari list lokal
        foreach ($this->listPembalap as $index => $p) {
            if ($p->getId() == $id) {
                unset($this->listPembalap[$index]);
                $this->listPembalap = array_values($this->listPembalap); // reset index
                break;
            }
        }
    }
}

?>