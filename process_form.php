<?php
include 'db_connect.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_input = $_POST['email'] ?? '';

    // Kontroll për input të zbrazët
    if (empty($email_input)) {
        echo "Ju lutem shtypni një email.";
        exit;
    }

    // Pregatitja e query-t
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email_input);
    $stmt->execute();
    $result = $stmt->get_result();

    // Shfaqja e rezultateve
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "User: " . htmlspecialchars($row['username']) . "<br>";
        }
    } else {
        echo "Nuk u gjet asnjë user me këtë email.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Ky skedar duhet të thirret përmes metodës POST.";
}
?>
