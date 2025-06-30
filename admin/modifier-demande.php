<?php
// -- Démarrage de la session pour accéder à la variable admin et au token CSRF --
session_start();

// -- Redirection si l'utilisateur n'est pas connecté en tant qu'admin --
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

// -- Génération du token CSRF s'il n'existe pas encore --
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// -- Connexion à la base de données --
require_once '../includes/config.php';

// -- Récupération de l'ID de la demande depuis l'URL (GET), avec validation --
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    die('ID invalide');
}

// -- Récupération de la demande dans la base de données --
$stmt = $pdo->prepare("SELECT * FROM demandes_contact WHERE id = ?");
$stmt->execute([$id]);
$demande = $stmt->fetch();

if (!$demande) {
    die('Demande non trouvée');
}

// -- Variable pour stocker les erreurs éventuelles --
$errors = '';

// -- Traitement du formulaire après soumission (POST) --
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // -- Vérification du token CSRF --
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('❌ Jeton CSRF invalide. Veuillez recharger la page.');
    }

    // -- Récupération et nettoyage des données envoyées --
    $nom = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // -- Validation des champs --
    if ($nom && filter_var($email, FILTER_VALIDATE_EMAIL) && $message) {
        // -- Requête SQL préparée pour mettre à jour la demande --
        $stmt = $pdo->prepare("UPDATE demandes_contact SET nom = ?, email = ?, message = ? WHERE id = ?");
        $stmt->execute([$nom, $email, $message, $id]);

        // -- Redirection vers la liste après modification --
        header('Location: admin-demandes.php');
        exit;
    } else {
        $errors = 'Veuillez remplir tous les champs correctement.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier demande</title>
  <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>

  <h2>✏️ Modifier la demande #<?= htmlspecialchars($id) ?></h2>

  <?php if ($errors): ?>
    <p style="color:red;"><?= htmlspecialchars($errors) ?></p>
  <?php endif; ?>

  <form method="post" action="">
    <label>Nom : 
      <input type="text" name="nom" value="<?= htmlspecialchars($demande['nom']) ?>" required>
    </label><br>

    <label>Email : 
      <input type="email" name="email" value="<?= htmlspecialchars($demande['email']) ?>" required>
    </label><br>

    <label>Message : 
      <textarea name="message" required><?= htmlspecialchars($demande['message']) ?></textarea>
    </label><br>

    <!-- Jeton CSRF caché -->
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

    <button type="submit">✅ Enregistrer les modifications</button>
  </form>

  <p><a href="admin-demandes.php">← Retour à la liste</a></p>

</body>
</html>
