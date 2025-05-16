<?php
$conn = new mysqli("localhost", "root", "", "parfume_db");

if ($conn->connect_error) {
    die("Gabim ne lidhje: " . $conn->connect_error);
}
?>