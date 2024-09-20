<?php
include 'config.php';

$query = $pdo->query('SELECT * FROM produits');
$produits = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique en ligne</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Nos produits</h1>
    <div class="produits">
        <?php foreach ($produits as $produit): ?>
            <div class="produit">
                <img src="images/<?= $produit['image']; ?>" alt="<?= $produit['nom']; ?>">
                <h2><?= $produit['nom']; ?></h2>
                <p><?= $produit['description']; ?></p>
                <p>Prix : <?= $produit['prix']; ?> €</p>
                <a href="panier.php?ajouter=<?= $produit['id']; ?>">Ajouter au panier</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
