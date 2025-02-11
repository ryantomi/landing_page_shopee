<?php
session_start(); // Memulai sesi
session_destroy(); // Menghancurkan sesi
header("Location: index.html"); // Arahkan ke halaman login
exit();
?>
