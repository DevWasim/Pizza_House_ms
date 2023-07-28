<?php require_once '../database/connection.php'; ?>


<?php
session_start();
if (isset($_SESSION['admin_id'])) {


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
} else {
    header('Location: ./index.php');
}


$sql = "DELETE FROM `users` WHERE `user_id` = $id";

if ($conn->query($sql)) {
    header('Location: ./index.php');
} else {
    echo "User has been falied to delete";
}
}else{
    header('location: ../adminlogin/admin_login.php');
}

?>