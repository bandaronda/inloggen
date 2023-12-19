<?php
session_start();

include 'db.php';

$database = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ingevoerdeGebruikersnaam = $_POST['gebruikersnaam'];
    $ingevoerdWachtwoord = $_POST['wachtwoord'];

    $gebruiker = $database->haalGebruikerOpNaam($ingevoerdeGebruikersnaam);

    if ($gebruiker && password_verify($ingevoerdWachtwoord, $gebruiker['wachtwoord'])) {
        $_SESSION['gebruikersnaam'] = $ingevoerdeGebruikersnaam;

        if ($ingevoerdeGebruikersnaam === "admin") {
            header("Location: home.php");
        } else {
            header("Location: welkom.php");
        }
        exit();
    } else {
        $foutmelding = "Ongeldige gebruikersnaam of wachtwoord.";
    }

    $database->sluitVerbinding();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Link to Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <?php
    // Toon foutmelding indien aanwezig
    if (isset($foutmelding)) {
        echo "<div class='alert alert-danger'>{$foutmelding}</div>";
    }
    ?>

    <!-- HTML-formulier voor inloggen -->
    <form method="post" action="log_in.php">
        <label for="email">E-mail:</label>
        <input type="email" name="email" class="form-control" required><br>

        <label for="wachtwoord">Wachtwoord:</label>
        <input type="password" name="wachtwoord" class="form-control" required><br>

        <input type="submit" value="Inloggen" class="btn btn-primary">
    </form>

    <!-- Link naar registratiepagina -->
    <p class="mt-3">Geen account? <a href="register.php">Registreer hier</a></p>
</div>

</body>
</html>
