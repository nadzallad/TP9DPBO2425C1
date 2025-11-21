<?php

interface KontrakViewSirkuit
{
    //menampilkan data sirkuit
    public function tampilSirkuit($listSirkuit): string;
    //menampilkan form tambah/edit sirkuit
    public function tampilFormSirkuit($data = null): string;
}

?>