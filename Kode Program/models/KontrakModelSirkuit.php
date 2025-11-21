<?php

interface KontrakModelSirkuit
{
    //mendapatkan seluruh data, dan mendapatkan data berdasarkan id
    public function getAllSirkuit(): array;
    public function getSirkuitById($id): ?array;
    
    // method crud sirkuit
    public function addSirkuit($nama, $lokasi, $kapasitas_penonton, $rekor_pembalap, $rekor_waktu): void;
    public function updateSirkuit($id, $nama, $lokasi, $kapasitas_penonton, $rekor_pembalap, $rekor_waktu): void;
    public function deleteSirkuit($id): void;
}

?>