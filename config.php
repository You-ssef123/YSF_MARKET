<?php
$host = 'YSF-MARKET.free.nf';
$dbname = 'boutique';
$username = 'root';  // Remplacez par votre nom d'utilisateur
$password = '';      // Remplacez par votre mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
