<?php
// -- initialisation de la session et configuration des erreurs --
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// --Générer un jeton CSRF si inxistant --
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
// -- Connexion à la Base de Données --
require_once '../includes/config.php';

// -- Variable qui stocke les erreurs --
$errors = '';
// -- Traitement du formulaire à la soumission --
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // -- Vérification du jeton CSRF--
       if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('❌ Jeton CSRF invalide. Rechargement de la page nécessaire.');
    }
    // -- Récupération et sécurisation des champs du formulaire --
    $user = trim($_POST['user'] ?? '');
    $pass = trim($_POST['pass'] ?? '');

   // -- Requète SQL préparée pour éviter les injections --
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$user]);
    
    // -- fetch va récupérer le résultat de la requète  --
    $admin = $stmt->fetch();
   
   // -- Vérification du mot de passe avec password_verify --
    if ($admin && password_verify($pass, $admin['password'])) {

        // Authentification réussie ? ouverture de la session admin --
        $_SESSION['admin'] = true;
        // -- durée maximale de la session : 1800 secondes = 30 minutes --
         $_SESSION['expires_at'] = time() + 1800; 
        header('Location: admin-demandes.php');
        exit;
    } else {
        // -- Autehification échouée ? = Message :"Identifiants invalides" --
        $errors = "Identifiants invalides";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Connexion Admin</title>
  <link rel="stylesheet" href="../CSS/style.css">
</head>
<body class="admin-login">

  <h1>Connexion Admin</h1>

  <?php if ($errors): ?>
    <p class="error"><?= htmlspecialchars($errors) ?></p>
  <?php endif; ?>

  <form method="post" action="">
    <label for="user">Utilisateur :</label>
    <input type="text" id="user" name="user" required autofocus />
    
    <label for="pass">Mot de passe :</label>
    <input type="password" id="pass" name="pass" required />
    <!-- Protection contre les attaques CSRF et discret via hidden-->
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>"> 
    <button type="submit">Se connecter</button>
  </form>

</body>
</html>
