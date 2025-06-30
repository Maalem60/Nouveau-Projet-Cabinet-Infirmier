<?php
// --- Initialisation de la session ---
session_start();

// --- Vérifie que l'utilisateur est bien connecté en tant qu'admin ---
if (!isset($_SESSION['admin'])) {
    // Redirige vers la page de connexion si l'accès est non autorisé
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Tableau de bord Admin</title>

  <!-- Lien vers la feuille de style principale -->
  <link rel="stylesheet" href="../CSS/style.css">
</head>
<body class="admin-dashboard">

  <h1>🛠️ Tableau de bord administrateur</h1>

  <!-- Liens vers les pages d'administration -->
  <ul class="admin-links">
    <li><a href="admin-demandes.php">📬 Gérer les demandes de contact</a></li>
    <li><a href="users.php">👥 Gérer les utilisateurs</a></li>
  </ul>

  <!-- Lien de déconnexion -->
  <p class="logout">
    <a href="logout.php">🔓 Déconnexion</a>
  </p>

</body>
</html>
