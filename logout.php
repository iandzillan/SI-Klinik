<?php
// Jalankan session
session_start();

// Hancurkan session
$_SESSION = [];
session_unset();
session_destroy();

// Hancurkan cookie
setcookie('key', '', time() - 3600);
setcookie('identifier', '', time() - 3600);

// Alihkan user ke halaman login
header('Location: login.php');
