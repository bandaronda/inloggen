<?php
include 'db.php';

$database = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $leeftijd = $_POST['leeftijd'];

    $database->updateGebruiker($id, $voornaam, $achternaam, $leeftijd);

    echo "Gebruiker met ID $id is bijgewerkt";

    header("Location: home.php");
    exit();
}

$gebruikers = $database->haalGebruikersOp();

echo "<form method='post' action='update.php'>";
echo "<select name='id'>";

foreach ($gebruikers as $gebruiker) {
    echo "<option value='{$gebruiker['id']}'>{$gebruiker['naam']} {$gebruiker['achternaam']}</option>";
}

echo "</select>";
echo "Voornaam: <input type='text' name='voornaam'><br>";
echo "Achternaam: <input type='text' name='achternaam'><br>";
echo "Leeftijd: <input type='text' name='leeftijd'><br>";
echo "<input type='submit' value='Update'>";
echo "</form>";

$database->sluitVerbinding();
?>
