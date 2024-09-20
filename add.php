<?php
$host = 'YSF-MARKET.free.nf';
$dbname = 'boutique';
$username = 'root';  // Remplacez par votre nom d'utilisateur
$password = '';      // Remplacez par votre mot de passe
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">
        <input type="text" name="nom" placeholder="nom"> <br>
        <input type="text" name="description" placeholder="description"> <br>
        <input type="number" name="prix" placeholder="prix"> <br>
        <input type="text" name="image" placeholder="image"> <br>
        <button type="submit" name="save">ADD</button>
        <button type="reset">RESET</button>
    </form>



    <?php
    try {
        if (isset($_POST['save'])) {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $query = $pdo->prepare("INSERT INTO produits(nom,description,prix,image) 
    VALUES(?,?,?,?)");
            $query->bindValue(1, $_POST['nom']);
            $query->bindValue(2, $_POST['description']);
            $query->bindValue(3, $_POST['prix']);
            $query->bindValue(4, $_POST['image']);
            $query->execute();
            echo "<script>alert('Success!');</script>";
        }
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
