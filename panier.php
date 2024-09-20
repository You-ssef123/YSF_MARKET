<?php
session_start();
include 'config.php';

// Initialiser le panier
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Ajouter un produit au panier
if (isset($_GET['ajouter'])) {
    $idProduit = (int)$_GET['ajouter'];
    
    if (!isset($_SESSION['panier'][$idProduit])) {
        $_SESSION['panier'][$idProduit] = 1;
    } else {
        $_SESSION['panier'][$idProduit]++;
    }
    header('Location: panier.php');
    exit();
}

// Afficher le contenu du panier
$produitsPanier = [];
$total = 0;

if (!empty($_SESSION['panier'])) {
    $ids = array_keys($_SESSION['panier']);
    $idsList = implode(',', $ids);
    $query = $pdo->query("SELECT * FROM produits WHERE id IN ($idsList)");
    $produitsPanier = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($produitsPanier as $produit) {
        $total += $produit['prix'] * $_SESSION['panier'][$produit['id']];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Votre panier</h1>

    <?php if (empty($produitsPanier)): ?>
        <p>Votre panier est vide.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produitsPanier as $produit): ?>
                    <tr>
                        <td><?= $produit['nom']; ?></td>
                        <td><?= $_SESSION['panier'][$produit['id']]; ?></td>
                        <td><?= $produit['prix']; ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p>Total : <?= $total; ?> €</p>
        <a href="paiement.php">Passer à la caisse</a>
    <?php endif; ?>
</body>
</html>
