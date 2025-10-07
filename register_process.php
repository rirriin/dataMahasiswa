<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama             = trim($_POST['nama'] ?? '');
    $username         = trim($_POST['username'] ?? '');
    $email            = trim($_POST['email'] ?? '');
    $password         = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validasi input
    if ($nama === '' || $username === '' || $email === '' || $password === '' || $confirm_password === '') {
        echo "<script>alert('Semua field wajib diisi!'); window.location.href='register.php';</script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Format email tidak valid!'); window.location.href='register.php';</script>";
        exit;
    }

    if ($password !== $confirm_password) {
        echo "<script>alert('Konfirmasi password tidak cocok!'); window.location.href='register.php';</script>";
        exit;
    }

    // Cek username/email sudah terdaftar atau belum
    $check = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1");
    if (!$check) {
        die("Query check gagal: " . $conn->error);
    }
    $check->bind_param("ss", $username, $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('Username atau email sudah terdaftar!'); window.location.href='register.php';</script>";
        $check->close();
        exit;
    }
    $check->close();

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert data ke tabel users
    $stmt = $conn->prepare("INSERT INTO users (nama, username, email, `password`) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Query insert gagal: " . $conn->error);
    }
    $stmt->bind_param("ssss", $nama, $username, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href='login.php';</script>";
    } else {
        error_log("Register error: " . $stmt->error);
        echo "<script>alert('Terjadi kesalahan pada sistem.'); window.location.href='register.php';</script>";
    }

    $stmt->close();
}
?>
