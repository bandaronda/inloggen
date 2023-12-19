<?php
include 'db.php';

$database = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ingevoerdeNaam = $_POST['naam'];
    $ingevoerdWachtwoord = $_POST['wachtwoord'];

    $bestaandeGebruiker = $database->haalGebruikerOpNaam($ingevoerdeNaam);

    if (!$bestaandeGebruiker) {
        $hashedWachtwoord = password_hash($ingevoerdWachtwoord, PASSWORD_DEFAULT);
        $database->voegGebruikerToe($ingevoerdeNaam, $hashedWachtwoord);
        header("Location: log_in.php");
        exit();
    } else {
        $foutmelding = "Gebruikersnaam is al in gebruik.";
    }
}

$gebruikers = $database->haalGebruikersOp();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

    <!-- HTML-formulier voor registratie -->
    <form method="post" action="register.php">
        <label for="email">E-mail:</label>
        <input type="email" name="email" class="form-control" required><br>

        <label for="wachtwoord">Wachtwoord:</label>
        <input type="password" name="wachtwoord" class="form-control" required><br>

        <input type="submit" value="Registreren" class="btn btn-success">
    </form>

    <!-- Link naar inlogpagina -->
    <p class="mt-3">Heeft u al een account? <a href="log_in.php">Log hier in</a></p>
</div>

</body>
</html>
