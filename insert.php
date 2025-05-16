<?php
include 'db.php';

$sql = "INSERT INTO parfume (emri, pershkrimi, cmimi) VALUES 
('Le Male Eau de Toilette', 'Aromë klasike me lavender dhe vanilje.', 89.99),
('Scandal Pour Homme', 'E fuqishme me nota karamele dhe salvie.', 102.50),
('Le Beau Eau de Parfum', 'E ëmbël me kokosit dhe tonka bean.', 96.75)";

if ($conn->query($sql) === TRUE) {
    echo "Produktet u shtuan me sukses.";
} else {
    echo "Gabim ne INSERT: " . $conn->error;
}
?>
