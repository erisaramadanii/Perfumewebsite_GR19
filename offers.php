<?php 
class Parfum{
  public $emri;
  public $foto;
  public $cmimi;
  public $gjinia;

  public function__construct($emri, $cmimi, $gjinia) {
  $this->emri = $emri;
  $this->foto = $foto;
  $this->cmimi = $cmimi;
  $this->gjinia = $gjinia;
}
}
$parfumet = [
  new Parfum(emri: "Classique", foto: "F1_Classique.jpg", cmimi: 55, gjinia: "female"),
  new Parfum(emri: "Scandal", foto: "F1_Scandal.jpg", cmimi: 70, gjinia: "female"),
  new Parfum(emri: "La Belle", foto: "F1_La_Belle.webp.jpg", cmimi: 68, gjinia: "female"),
new Parfum(emri: "So Scandal", foto: "F1_So_Scandal.jpg", cmimi: 78, gjinia: "female"),
  new Parfum(emri: "La Male", foto: "M5_La_Male.jpg", cmimi: 60, gjinia: "male"),
  new Parfum(emri: "La Male Le Parfum", foto: "M2_La_Male_Le_Parfum.jpg", cmimi: 75, gjinia: "male"),
   new Parfum("La Beau", "M3_La_Beau.webp", 65, "male"),
    new Parfum("Ultra Male", "M4_Ultra_Male.jpg", 80, "male"),
];

$gjinia = isset($_GET['gjinia']) ? $_GET['gjinia'] : null;
$sort = $_GET['sort'] ?? null;
$gjiniaArray = is_array($gjinia) ? $gjinia : explode(',', $gjinia);

if ($gjinia) {
    $parfumet = array_filter($parfumet, fn($p) => in_array($p->gjinia, $gjiniaArray));
}

if ($sort === "asc") {
    usort($parfumet, fn($a, $b) => $a->cmimi <=> $b->cmimi);
} elseif ($sort === "desc") {
    usort($parfumet, fn($a, $b) => $b->cmimi <=> $a->cmimi);
}
?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Ofertat e Parfumave</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 10px;
            font-size: 32px;
            color: #333;
        }

        .container {
            display: flex;
            width: 100%;
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .sidebar {
            width: 280px;
            background-color: #fff;
            padding: 20px;
            border-right: 1px solid #ccc;
            box-shadow: 2px 0 5px rgba(0,0,0,0.05);
            box-sizing: border-box;
            height: fit-content;
            font-size: 16px;
            line-height: 1.6;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(2, 1fr); 
            gap: 50px 60px;
            flex-grow: 1;
            padding: 0 40px;
        }

        .perfume {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            border-radius: 10px;
            transition: transform 0.2s;
            box-sizing: border-box;
            position: relative;
            height: 350px;
        }

        .perfume:hover {
            transform: scale(1.03);
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .perfume img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .perfume h4 {
            margin: 10px 0 5px;
            font-size: 18px;
        }

        .price {
            font-size: 18px;
            margin-top: 10px;
        }

        .old-price {
            text-decoration: line-through;
            color: #ff0000;
            font-weight: bold;
        }

        .new-price {
            font-weight: bold;
            color: #28a745;
        }

        .buttons {
            position: absolute;
            bottom: 10px;
            left: 10px;
            right: 10px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
            display: none; 
        }

        .perfume:hover .buttons {
            display: flex;
        }

        .btn {
            padding: 5px 10px;
            background-color: #111;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 12px;
            transition: background-color 0.2s;
        }

        .btn:hover {
            background-color: #444;
        }

        .discover {
            background-color: #007bff;
        }

        .shop-now {
            background-color: #28a745;
        }

        .filter-group {
            margin-bottom: 20px;
        }

        .btn {
            margin-top: 15px;
            padding: 10px;
            background-color: #111;
            color: white;
            border: none;
            width: 100%;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #444;
        }

        .sort-select {
            width: 100%;
            padding: 5px;
            border-radius: 5px;
        }

        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
            max-width: 400px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-img {
            width: 100%;
            max-height: 200px;
            object-fit: contain;
            margin-bottom: 15px;
        }
/* Input for Quantity and ML */
        .quantity-group {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }

        .quantity-group select, .quantity-group input {
            padding: 5px;
            font-size: 14px;
            border-radius: 5px;
            width: 48%;
        }

        .total-price {
            font-weight: bold;
            color: #28a745;
            margin-top: 10px;
        }

        .order-btn {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
        }
        .order-btn:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
