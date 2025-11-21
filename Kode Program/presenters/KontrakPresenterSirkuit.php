<?php

interface KontrakPresenterSirkuit
{
    // method untuk tampilkan sirkuit
    public function tampilkanSirkuit(): string;

    // method untuk tampilkan form sirkuit
    public function tampilkanFormSirkuit($id = null): string;

    // method untuk CRUD sirkuit
    public function tambahSirkuit($nama, $lokasi, $kapasitas_penonton, $rekor_pembalap, $rekor_waktu): void;
    public function ubahSirkuit($id, $nama, $lokasi, $kapasitas_penonton, $rekor_pembalap, $rekor_waktu): void;
    public function hapusSirkuit($id): void;
}

?>