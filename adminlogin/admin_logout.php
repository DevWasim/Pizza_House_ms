<?php require_once '../database/connection.php'; ?>

<?php
session_start();
unset($_SESSION['admin_id']);
// session_destroy();

header('location: ./admin_login.php');

