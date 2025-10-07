<?php
include 'config.php';

$id = $_GET['id'] ?? 0;
$result = $conn->query("SELECT * FROM mahasiswa WHERE id=$id");
if (!$result || $result->num_rows === 0) {
    die("Data tidak ditemukan.");
}
$data = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama   = $_POST['nama'];
    $ttl    = $_POST['ttl'];
    $alamat = $_POST['alamat'];
    $nis    = $_POST['nis'];
    $prodi  = $_POST['prodi'];

    $stmt = $conn->prepare("UPDATE mahasiswa SET nama=?, ttl=?, alamat=?, nis=?, prodi=? WHERE id=?");
    $stmt->bind_param("sssssi", $nama, $ttl, $alamat, $nis, $prodi, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diupdate'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal update: ".$stmt->error."');</script>";
    }
}
?>

<h2>Edit Data</h2>
<form method="POST">
    <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required><br>
    <input type="date" name="ttl" value="<?= $data['ttl'] ?>" required><br>
    <input type="text" name="alamat" value="<?= htmlspecialchars($data['alamat']) ?>" required><br>
    <input type="text" name="nis" value="<?= htmlspecialchars($data['nis']) ?>" required><br>

    <select name="prodi" required>
        <option value="RPL" <?= $data['prodi']=="RPL"?"selected":"" ?>>RPL</option>
        <option value="TKJ" <?= $data['prodi']=="TKJ"?"selected":"" ?>>TKJ</option>
        <option value="Multimedia" <?= $data['prodi']=="Multimedia"?"selected":"" ?>>Multimedia</option>
    </select><br>

    <button type="submit">Update</button>
</form>
