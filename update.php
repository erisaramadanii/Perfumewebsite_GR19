<?php
include 'db.php';

$sql = "UPDATE parfume SET cmimi = 92.99 WHERE id = 1";

if ($conn->query($sql) === TRUE) {
    echo "Parfumi u përditësua me sukses.";
} else {
    echo "Gabim ne UPDATE: " . $conn->error;
}
?>
