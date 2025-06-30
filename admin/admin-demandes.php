<?php
// -- Démarrage de la session pour accéder aux variables de session --
session_start();

// -- Vérification si l'administrateur est connecté ET si la session n'a pas expiré --
if (!isset($_SESSION['admin']) || !isset($_SESSION['expires_at']) || time() > $_SESSION['expires_at']) {
    session_unset();             // Vide toutes les variables de session
    session_destroy();           // Détruit complètement la session
    header('Location: login.php?timeout=1'); // Redirection vers la page de login avec indication de timeout
    exit; // Interrompt l'exécution du script
}

// -- Si l'utilisateur est actif, on rallonge la durée de session de 30 minutes --
$_SESSION['expires_at'] = time() + 1800; // 1800 secondes = 30 minutes

// -- Inclusion du fichier de connexion à la base de données --
require_once __DIR__ . '/../includes/config.php';

// -- Requête SQL pour récupérer toutes les demandes de contact triées par date (les plus récentes d'abord) --
$stmt = $pdo->query("SELECT * FROM demandes_contact ORDER BY date_envoi DESC");
$demandes = $stmt->fetchAll(); // -- Récupération de tous les résultats dans un tableau associatif --
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Demandes de contact</title>

  <!-- Lien vers le fichier CSS principal -->
  <link rel="stylesheet" href="../CSS/style.css">
</head>
<body class="admin-demandes">

  <!-- Titre principal de la page -->
  <h1>📬 Liste des demandes de contact</h1>

  <!-- Si des demandes existent, on affiche le tableau -->
  <?php if (count($demandes) > 0): ?>
    <table class="table-demandes">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>Téléphone</th>
          <th>Email</th>
          <th>Message</th>
          <th>Date d’envoi</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($demandes as $demande): ?>
          <tr>
            <td><?= $demande['id'] ?></td>
            <td><?= htmlspecialchars($demande['nom']) ?></td>
            <td><?= htmlspecialchars($demande['telephone']) ?></td>
            <td><?= htmlspecialchars($demande['email']) ?></td>

            <!-- Affichage du message avec retour à la ligne, décodé pour lire les caractères spéciaux -->
            <td><?= nl2br(htmlspecialchars_decode($demande['message'])) ?></td>

            <td><?= $demande['date_envoi'] ?></td>
            <td>
              <a href="modifier-demande.php?id=<?= $demande['id'] ?>">✏️ Modifier</a> |
              <a href="supprimer-demande.php?id=<?= $demande['id'] ?>"
                 onclick="return confirm('Confirmer la suppression ?')">🗑️ Supprimer</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <!-- Message si aucune demande n’est trouvée -->
    <p>Aucune demande reçue pour le moment.</p>
  <?php endif; ?>

  <!-- Lien de retour vers le tableau de bord -->
  <p><a href="admin-dashboard.php">← Retour au tableau de bord</a></p>

</body>
</html>
