<?php
include 'db.php';

$sql = "DELETE FROM parfume WHERE id = 2";

if ($conn->query($sql) === TRUE) {
    echo "Parfumi u fshi me sukses.";
} else {
    echo "Gabim ne DELETE: " . $conn->error;
}
?>
