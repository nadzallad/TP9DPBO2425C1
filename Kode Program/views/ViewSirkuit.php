<?php

include_once ("KontrakViewSirkuit.php");
include_once ("models/Sirkuit.php");

class ViewSirkuit implements KontrakViewSirkuit{

    public function __construct(){
        // Konstruktor kosong
    }

    // Method untuk menampilkan daftar sirkuit
    public function tampilSirkuit($listSirkuit): string {
        // Build table rows
        $tbody = '';
        $no = 1;
        foreach($listSirkuit as $sirkuit){
            $tbody .= '<tr>';
            $tbody .= '<td class="col-id">'. $no .'</td>';
            $tbody .= '<td>'. htmlspecialchars($sirkuit->getNama()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($sirkuit->getLokasi()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($sirkuit->getKapasitasPenonton()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($sirkuit->getRekorPembalap()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($sirkuit->getRekorWaktu()) .'</td>';
            $tbody .= '<td class="col-actions">
                    <a href="index.php?tab=sirkuit&screen=edit&id='. $sirkuit->getId() .'" class="btn btn-edit">Edit</a>
                    <button data-id="'. $sirkuit->getId() .'" class="btn btn-delete">Hapus</button>
                  </td>';
            $tbody .= '</tr>';
            $no++;
        }

        // Load the page template and inject rows + total count
        $templatePath = __DIR__ . '/../template/skin_sirkuit.html';
        $template = '';
        if (file_exists($templatePath)) {
            $template = file_get_contents($templatePath);
            $template = str_replace('<!-- PHP will inject rows here -->', $tbody, $template);
            $total = count($listSirkuit);
            $template = str_replace('Total:', 'Total: ' . $total, $template);
            return $template;
        }

        // Fallback: just return the rows if template is missing
        return $tbody;
    }

    // Method untuk menampilkan form tambah/ubah sirkuit
    public function tampilFormSirkuit($data = null): string {
        $template = file_get_contents(__DIR__ . '/../template/form_sirkuit.html');
        if ($data) {
            $template = str_replace('value="add" id="sirkuit-action"', 'value="edit" id="sirkuit-action"', $template);
            $template = str_replace('value="" id="sirkuit-id"', 'value="' . htmlspecialchars($data['id']) . '" id="sirkuit-id"', $template);
            $template = str_replace('id="nama" name="nama" type="text" placeholder="Nama sirkuit"', 'id="nama" name="nama" type="text" placeholder="Nama sirkuit" value="' . htmlspecialchars($data['nama']) . '"', $template);
            $template = str_replace('id="lokasi" name="lokasi" type="text" placeholder="Lokasi sirkuit"', 'id="lokasi" name="lokasi" type="text" placeholder="Lokasi sirkuit" value="' . htmlspecialchars($data['lokasi']) . '"', $template);
            $template = str_replace('id="kapasitas_penonton" name="kapasitas_penonton" type="number" placeholder="Kapasitas penonton"', 'id="kapasitas_penonton" name="kapasitas_penonton" type="number" placeholder="Kapasitas penonton" value="' . htmlspecialchars($data['kapasitas_penonton']) . '"', $template);
            $template = str_replace('id="rekor_pembalap" name="rekor_pembalap" type="text" placeholder="Nama pembalap pemegang rekor"', 'id="rekor_pembalap" name="rekor_pembalap" type="text" placeholder="Nama pembalap pemegang rekor" value="' . htmlspecialchars($data['rekor_pembalap']) . '"', $template);
            $template = str_replace('id="rekor_waktu" name="rekor_waktu" type="text" placeholder="Waktu rekor (HH:MM:SS)"', 'id="rekor_waktu" name="rekor_waktu" type="text" placeholder="Waktu rekor (HH:MM:SS)" value="' . htmlspecialchars($data['rekor_waktu']) . '"', $template);
        }
        return $template;
    }
}

?>