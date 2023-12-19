<?php
session_start();

if (!isset($_SESSION['gebruikersnaam'])) {
    header("Location: log_in.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welkom</title>

    <!-- Voeg de Bootstrap CSS toe -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <p class="fs-4">Welkom, <?php echo $_SESSION['gebruikersnaam']; ?>!</p>

    <a class="btn btn-danger" href="log_out.php">Uitloggen</a>
</div>

<!-- Voeg de Bootstrap JS toe (optioneel, afhankelijk van je behoeften) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
