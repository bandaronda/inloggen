<?php
include 'db.php';

$database = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    $database->verwijderGebruiker($id);

    echo "Gebruiker met ID $id is verwijderd";

    header("Location: home.php");
    exit();
}

$gebruikers = $database->haalGebruikersOp();

echo "<form method='post' action='delete.php'>";
echo "<select name='id'>";

foreach ($gebruikers as $gebruiker) {
    echo "<option value='{$gebruiker['id']}'>{$gebruiker['naam']} {$gebruiker['achternaam']}</option>";
}

echo "</select>";
echo "<button type='submit'>Delete</button>";
echo "</form>";

$database->sluitVerbinding();
?>
