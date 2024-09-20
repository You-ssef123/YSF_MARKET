<?php
session_start();
include 'config.php';

// Calcul du total à payer
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
    <title>Paiement avec PayPal</title>
    <link rel="stylesheet" href="style.css">
    <!-- PayPal SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=AWpDJ0mx3wcxndH5jRaPl_0vMOV_hAf7jk5oGoROVnf2YlW_inxRB5ugzxvI-JH-eOMkaAbysfFooFkO&currency=EUR"></script>
</head>
<body>
    <h1>Paiement sécurisé avec PayPal</h1>

    <?php if ($total == 0): ?>
        <p>Votre panier est vide. <a href="index.php">Retour à la boutique</a></p>
    <?php else: ?>
        <p>Total à payer : <strong><?= number_format($total, 2); ?> €</strong></p>

        <!-- Bouton PayPal -->
        <div id="paypal-button-container"></div>

        <script>
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: '<?= number_format($total, 2); ?>' // Le montant total en euros
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        window.location.href = "confirmation.php"; // Redirection après paiement réussi
                    });
                }
            }).render('#paypal-button-container'); // Afficher le bouton PayPal
        </script>
    <?php endif; ?>
</body>
</html>
