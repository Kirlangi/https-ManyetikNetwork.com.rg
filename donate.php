<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include('includes/db_connect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST['amount'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO donations (user_id, amount) VALUES ('$user_id', '$amount')";
    if ($conn->query($sql) === TRUE) {
        echo "Bağışınız başarıyla alındı!";
        // VIP verisi güncellenebilir
        $sql_vip = "UPDATE users SET vip_status = 1 WHERE id = '$user_id'";
        $conn->query($sql_vip);
    } else {
        echo "Hata: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bağış Yap</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Bağış Yap ve VIP Ol!</h2>
        <form method="POST">
            <label for="amount">Bağış Miktarı:</label>
            <input type="number" id="amount" name="amount" required>

            <input type="submit" value="Bağış Yap">
        </form>
    </div>
</body>
</html>