<?php
include 'db.php';

$database = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $database->voegGebruikerToe("Voornaam", "Wachtwoord");
        echo "Nieuwe gebruiker toegevoegd.";

        header("Location: home.php");
        exit();
    }
}

$gebruikers = $database->haalGebruikersOp();

echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Wachtwoord</th>
            <th>Bewerken</th>
            <th>Verwijderen</th>
        </tr>";

foreach ($gebruikers as $gebruiker) {
    echo "<tr>
            <td>{$gebruiker['id']}</td>
            <td>{$gebruiker['naam']}</td>
            <td>{$gebruiker['wachtwoord']}</td>
            <td><a href='update.php?id={$gebruiker['id']}'>Edit</a></td>
            <td><a href='delete.php?id={$gebruiker['id']}'>Delete</a></td>
          </tr>";
}

echo "</table>";

$database->sluitVerbinding();
?>

<form method='post' action='home.php'>
    <input type='submit' name='submit' value='Voeg nieuwe gebruiker toe'>
</form>

<p>wilt u terug? <a href="log_in.php">klik hier</a></p>
