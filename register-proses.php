<?php
include 'configdb.php';

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$mysqli->query("INSERT INTO users (nama, username, password, role)
                VALUES ('$nama','$username','$password','guru')");

header("Location: login.php");
exit;
