<?php

interface KontrakView
{
    //menmapilkan data pembalap
    public function tampilPembalap($listPembalap): string;

    //menampilkan form tambah atau ubah
    public function tampilFormPembalap($data = null): string;
}

?>