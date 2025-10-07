<?php
session_start();
include 'config.php'; // koneksi database ($conn)

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        echo "<script>alert('Username dan password wajib diisi!'); window.history.back();</script>";
        exit;
    }

    // Ambil data user
    $stmt = $conn->prepare("SELECT id, username, password, nama FROM users WHERE username=? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        $message = "Login berhasil! Selamat datang, " . ($user['nama'] ?? $user['username']);
        echo "<script>alert(" . json_encode($message) . "); window.location='index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Username atau password salah!'); window.location='login.php';</script>";
        exit;
    }
}
?>
