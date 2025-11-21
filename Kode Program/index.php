<?php

include_once("models/DB.php");
include("models/TabelPembalap.php");
include("models/TabelSirkuit.php");
include("views/ViewPembalap.php");
include("views/ViewSirkuit.php");
include("presenters/PresenterPembalap.php");
include("presenters/PresenterSirkuit.php");

// Inisialisasi kedua presenter
$tabelPembalap = new TabelPembalap('localhost', 'mvp_db', 'root', '');
$viewPembalap = new ViewPembalap();
$presenterPembalap = new PresenterPembalap($tabelPembalap, $viewPembalap);

$tabelSirkuit = new TabelSirkuit('localhost', 'mvp_db', 'root', '');
$viewSirkuit = new ViewSirkuit();
$presenterSirkuit = new PresenterSirkuit($tabelSirkuit, $viewSirkuit);

// Tentukan tab aktif
$activeTab = $_GET['tab'] ?? 'pembalap';

// Handle POST actions (CRUD operations)
if(isset($_POST['action'])){
    $action = $_POST['action'];
    
    if($activeTab == 'pembalap'){
        if($action == 'add'){
            // Tambah pembalap baru
            $presenterPembalap->tambahPembalap(
                $_POST['nama'],
                $_POST['tim'],
                $_POST['negara'],
                $_POST['poinMusim'],
                $_POST['jumlahMenang']
            );
        }
        else if($action == 'edit'){
            // Edit pembalap existing
            $presenterPembalap->ubahPembalap(
                $_POST['id'],
                $_POST['nama'],
                $_POST['tim'],
                $_POST['negara'],
                $_POST['poinMusim'],
                $_POST['jumlahMenang']
            );
        }
        else if($action == 'delete'){
            // Hapus pembalap
            $presenterPembalap->hapusPembalap($_POST['id']);
        }
    }
    else if($activeTab == 'sirkuit'){
        if($action == 'add'){
            // Tambah sirkuit baru
            $presenterSirkuit->tambahSirkuit(
                $_POST['nama'],
                $_POST['lokasi'],
                $_POST['kapasitas_penonton'],
                $_POST['rekor_pembalap'],
                $_POST['rekor_waktu']
            );
        }
        else if($action == 'edit'){
            // Edit sirkuit existing
            $presenterSirkuit->ubahSirkuit(
                $_POST['id'],
                $_POST['nama'],
                $_POST['lokasi'],
                $_POST['kapasitas_penonton'],
                $_POST['rekor_pembalap'],
                $_POST['rekor_waktu']
            );
        }
        else if($action == 'delete'){
            // Hapus sirkuit
            $presenterSirkuit->hapusSirkuit($_POST['id']);
        }
    }
    
    // Redirect back to list after action
    header("Location: index.php?tab=" . $activeTab);
    exit();
}

// Handle GET screens
if(isset($_GET['screen'])){
    if($_GET['screen'] == 'add'){
        if($activeTab == 'pembalap'){
            $formHtml = $presenterPembalap->tampilkanFormPembalap();
        } else {
            $formHtml = $presenterSirkuit->tampilkanFormSirkuit();
        }
        echo $formHtml;
    }
    else if($_GET['screen'] == 'edit' && isset($_GET['id'])){
        if($activeTab == 'pembalap'){
            $formHtml = $presenterPembalap->tampilkanFormPembalap($_GET['id']);
        } else {
            $formHtml = $presenterSirkuit->tampilkanFormSirkuit($_GET['id']);
        }
        echo $formHtml;
    }
} 
else{
    // Tampilkan list berdasarkan tab aktif
    if($activeTab == 'pembalap'){
        $html = $presenterPembalap->tampilkanPembalap();
    } else {
        $html = $presenterSirkuit->tampilkanSirkuit();
    }
    
    // Load template dan inject content
    echo wrapWithTemplate($html, $activeTab);
}

// Helper function untuk menggunakan template
function wrapWithTemplate($content, $activeTab) {
    $templatePath = __DIR__ . '/template/index.html';
    
    if (!file_exists($templatePath)) {
        return $content; // Fallback jika template tidak ada
    }
    
    $template = file_get_contents($templatePath);
    
    // Replace placeholder dengan content
    $template = str_replace('<!-- CONTENT_PLACEHOLDER -->', $content, $template);
    
    // Set active tab
    $template = str_replace('class="nav-pembalap"', 
                           $activeTab == 'pembalap' ? 'class="nav-pembalap active"' : 'class="nav-pembalap"', 
                           $template);
    $template = str_replace('class="nav-sirkuit"', 
                           $activeTab == 'sirkuit' ? 'class="nav-sirkuit active"' : 'class="nav-sirkuit"', 
                           $template);
    
    return $template;
}

?>