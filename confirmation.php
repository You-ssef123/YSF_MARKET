<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de paiement</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Paiement PayPal réussi !</h1>
    <p>Merci pour votre achat. Votre commande a été validée avec succès.</p>
    <p>Nous préparons votre commande et vous l'enverrons à l'adresse que vous avez indiquée.</p>
    <a href="index.php">Retourner à la boutique</a>

    <?php
    // Vider le panier après paiement
    $_SESSION['panier'] = [];
    ?>
</body>
</html>
