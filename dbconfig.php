<?php

$host = 'localhost';
$port = '5432';
$username = 'postgres';
$password = 'kidzania123';
$database = 'excel-sql';

// $conn = mysqli_connect($host, $username, $password, $database);
$conn = pg_connect("host=localhost port=5432 dbname=excel-sql user=postgres password=kidzania123");

if (!$conn) {
    die("Koneksi Gagal: " . pg_connect_error());
}
echo "Berhasil terkoneksi";
?>