<?php
session_start();

if (!isset($_SESSION['clicks'])) {
    $_SESSION['clicks'] = [];
}

if (isset($_GET['name'])) {
    $name = $_GET['name'];
    if (!isset($_SESSION['clicks'][$name])) {
        $_SESSION['clicks'][$name] = 0;
    }
    // Rrit klikimin vetëm nëse ka parametër 'increment=1'
    if (isset($_GET['increment']) && $_GET['increment'] == '1') {
        $_SESSION['clicks'][$name]++;
    }
    echo json_encode(['clicks' => $_SESSION['clicks'][$name]]);
    exit;
}

echo json_encode(['clicks' => 0]);
