<?php
class Database {
    private $host = 'localhost:3307';
    private $db   = 'Mensen';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';
    private $connection;

    public function __construct() {
        $this->connect();
    }

    public function connect() {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";

        try {
            $this->connection = new PDO($dsn, $this->user, $this->pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Databaseverbinding mislukt: " . $e->getMessage());
        }
    }

    public function voegGebruikerToe($naam, $wachtwoord) {
        $sql = "INSERT INTO gebruikers (naam, wachtwoord) VALUES (?, ?)";
        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(1, $naam, PDO::PARAM_STR);
        $stmt->bindParam(2, $wachtwoord, PDO::PARAM_STR);

        $stmt->execute();

        $stmt->closeCursor();
    }

    public function haalGebruikersOp($id = null) {
        if ($id !== null) {
            $sql = "SELECT * FROM gebruikers WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
        } else {
            $sql = "SELECT * FROM gebruikers";
            $stmt = $this->connection->query($sql);
        }

        $stmt->execute();
        $resultaat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $resultaat;
    }

    public function haalGebruikerOpNaam($naam) {
        $sql = "SELECT * FROM gebruikers WHERE naam = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $naam, PDO::PARAM_STR);
        $stmt->execute();
        $resultaat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultaat;
    }

    public function updateGebruiker($id, $naam, $wachtwoord) {
        $sql = "UPDATE gebruikers SET naam = ?, wachtwoord = ? WHERE id = ?";
        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(1, $naam, PDO::PARAM_STR);
        $stmt->bindParam(2, $wachtwoord, PDO::PARAM_STR);
        $stmt->bindParam(3, $id, PDO::PARAM_INT);

        $stmt->execute();

        $stmt->closeCursor();
    }

    public function verwijderGebruiker($id) {
        $sql = "DELETE FROM gebruikers WHERE id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        // Voeg indien nodig extra logica toe
    }

    public function sluitVerbinding() {
        $this->connection = null;
    }
}
?>
