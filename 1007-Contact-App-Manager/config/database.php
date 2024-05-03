<?php
require_once 'env.php';

// Mendefinisikan informasi koneksi database
$db_host = 'localhost'; // Ganti dengan host database Anda
$db_username = 'root'; // Ganti dengan username database Anda
$db_password = ''; // Ganti dengan password database Anda
$db_name = 'contact_app_manager'; // Ganti dengan nama database Anda

// Membuat koneksi ke database
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

