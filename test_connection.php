<?php
$host = "YSF-MARKET.free.nf";  // Remplacez par l'hôte correct
$username = "root";
$password = "";
$dbname = "boutique";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
} else {
    echo "Connexion réussie à la base de données MySQL";
}
?>
