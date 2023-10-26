<?php

        // mengambil data dari yang dikirim dari form index.php 
        $isi      = $_POST['message'];
        $nama     = $_POST['name'];
        $nim      = $_POST['NIM'];
    
    
        //mengambil dokumen surat
        $document = file_get_contents("SuratPernyataan.rtf");
     
    
        //mereplace semua kata yang ada di file dengan variabel
        $document = str_replace("#NAMA", $nama, $document);
        $document = str_replace("#NIM", $nim, $document);
        $document = str_replace("#ISI", $isi, $document);
     
    
        // header untuk membuka file yang dihasilkan dengna aplikasi Ms. Word
        // nama file yang dihasilkan adalah surat izin.docx
        header("Content-type: application/msword");
        header("Content-disposition: inline; filename=surathasil.doc");
        header("Content-length: " . strlen($document));
        echo $document;
    ?>