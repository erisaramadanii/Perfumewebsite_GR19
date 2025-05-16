<?php
include 'db.php';

$sql = "CREATE TABLE IF NOT EXISTS parfume (
    id INT AUTO_INCREMENT PRIMARY KEY,
    emri VARCHAR(100) NOT NULL,
    pershkrimi TEXT,
    cmimi DECIMAL(10,2)
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela u krijua me sukses.";
} else {
    echo "Gabim: " . $conn->error;
}
?>
