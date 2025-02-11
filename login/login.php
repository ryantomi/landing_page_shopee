<?php
session_start(); // Memulai sesi

// Koneksi ke database
$servername = "localhost"; // Ganti dengan server Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "login"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Menghindari SQL Injection
    $user = $conn->real_escape_string($user);
    $pass = $conn->real_escape_string($pass);

    // Query untuk memeriksa username dan password
    $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login berhasil, simpan informasi pengguna di sesi
        $_SESSION['username'] = $user; // Simpan username di sesi
        header("Location: dashboard.php"); // Arahkan ke dashboard
        exit(); // Pastikan untuk menghentikan eksekusi script setelah redirect
    } else {
        // Login gagal, simpan pesan kesalahan di sesi
        $_SESSION['error'] = "Username atau password salah.";
        header("Location: index.html"); // Arahkan kembali ke halaman login
        exit();
    }
}

$conn->close();
?>
