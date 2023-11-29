<?php require_once './database/connection.php'; ?>

<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('location: ./');
}

$sql = "DELETE FROM `users` WHERE `id` = $id";
if ($conn->query($sql)) {
    header('location: ./');
} else {
    die('Failed to delete');
}