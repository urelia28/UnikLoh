<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = $koneksi->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $query->bind_param('ss', $username, $password);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        
        // Simpan data pengguna ke session
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];
        $_SESSION['status'] = "login";
        
        // Redirect berdasarkan role
        if ($data['role'] == 'admin') {
            header("Location: admin/index.php");
        } elseif ($data['role'] == 'user') {
            header("Location: user/index.php");
        }else {
            header("Location: index.php?pesan=role_tidak_dikenal");
        }
    } else {
        header("Location: index.php?pesan=gagal");
    }
}
?>
