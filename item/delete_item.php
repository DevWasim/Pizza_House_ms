<?php require_once '../database/connection.php'; ?>

<?php

if (isset ($_GET['id']) && !empty ($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
} else {
    header('Location: ./index.php');
}

$sql = "DELETE FROM `items` WHERE `id` = $id";

if ($conn->query($sql)) {
    header('Location: ./index.php');
} else {
    echo 'User has failed to delete';
}