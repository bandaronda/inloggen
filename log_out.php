<?php
session_start(); // Start de sessie

// Controleer of de gebruiker is ingelogd
if (isset($_SESSION['gebruikersnaam'])) {
    // Vernietig de sessievariabele
    unset($_SESSION['gebruikersnaam']);

    // Optioneel: vernietig de hele sessie (alle sessievariabelen)
    // session_destroy();

    // Stuur de gebruiker door naar de inlogpagina of een andere pagina
    header("Location: log_in.php");
    exit();
} else {
    // Als de gebruiker niet is ingelogd, stuur ze dan naar de inlogpagina
    header("Location: log_in.php");
    exit();
}
?>
