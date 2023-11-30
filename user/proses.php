<?php
// mengambil data dari yang dikirim dari form user-dashboard.php
$isi      = $_POST['message'];
$nama     = $_POST['name'];
$nim      = $_POST['NIM'];
$nomor    = $_POST['NoTelepon'];

$newLetter = array(
  'nama' => $nama,
  'nim' => $nim,
  'isi' => $isi,
  'status' => 'Menunggu',
  'dokumen' => $document,
);

$letters[] = $newLetter;

// Mengambil dokumen surat
$document = file_get_contents("SuratPernyataan.rtf");

// Mereplace semua kata yang ada di file dengan variabel
$document = str_replace("#NAMA", $newLetter['nama'], $document);
$document = str_replace("#NIM", $newLetter['nim'], $document);
$document = str_replace("#ISI", $newLetter['isi'], $document);

// Header untuk membuka file yang dihasilkan dengan aplikasi Ms. Word
// Nama file yang dihasilkan adalah suratizindoc.docx
header("Content-type: application/msword");
header("Content-disposition: inline; filename=surathasil.doc");
header("Content-length: " . strlen($document));
echo $document;

// Simpan data surat ke dalam file atau database, atau array sementara
$letters = []; // Gantilah ini dengan metode penyimpanan yang sesuai (contoh: database)
$letters[] = $newLetter;

// Simpan data surat ke dalam file (contoh: surat-data.json)
file_put_contents('surat-data.json', json_encode($letters));

// Mengirim nomor telepon ke API setelah menghasilkan surat
$curl = curl_init();

curl_setopt_array($curl, array(
   CURLOPT_URL => 'https://api.fonnte.com/send',
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => '',
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 0,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => 'POST',
   CURLOPT_POSTFIELDS => array(
      'target' => $nomor,
      'message' => 'Surat sedang di urus'
   ),
   CURLOPT_HTTPHEADER => array(
      'Authorization: #!sUwuAe_f7DfW+XBsp2'
   ),
));

$response = curl_exec($curl);

curl_close($curl);

// Redirect to admin-dashboard.php after processing
header("Location: admin-dashboard.php");
exit();
?>
