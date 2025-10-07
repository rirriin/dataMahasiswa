<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id      = $_POST['id'] ?? ''; // deteksi mode edit
    $nama    = $_POST['nama'] ?? '';
    $ttl     = $_POST['ttl'] ?? '';
    $alamat  = $_POST['alamat'] ?? '';
    $nis     = $_POST['nis'] ?? '';
    $prodi   = $_POST['prodi'] ?? '';
    $kelamin = $_POST['kelamin'] ?? '';

    if ($nama && $ttl && $alamat && $nis && $prodi && $kelamin) {
        if (!empty($id)) {
            // === MODE EDIT ===
            $stmt = $conn->prepare("UPDATE mahasiswa 
                                    SET nama=?, ttl=?, alamat=?, nis=?, prodi=?, kelamin=? 
                                    WHERE id=?");
            $stmt->bind_param("ssssssi", $nama, $ttl, $alamat, $nis, $prodi, $kelamin, $id);
        } else {
            // === MODE TAMBAH ===
            $stmt = $conn->prepare("INSERT INTO mahasiswa (nama, ttl, alamat, nis, prodi, kelamin) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $nama, $ttl, $alamat, $nis, $prodi, $kelamin);
        }

        if ($stmt->execute()) {
            echo "<script>alert('Data berhasil disimpan'); window.location='index.php#tables';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "<script>alert('Semua field wajib diisi!'); window.history.back();</script>";
    }
}
?>
