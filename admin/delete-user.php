<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

require_once '../includes/config.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    die('ID invalide');
}

$stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if (!$user) {
    die('Utilisateur non trouvé');
}

if ($user['username'] === 'admin') {
    die('Impossible de supprimer l\'administrateur principal');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm']) && $_POST['confirm'] === 'oui') {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: users.php');
        exit;
    } else {
        header('Location: users.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Supprimer un utilisateur</title>
  <link rel="stylesheet" href="../CSS/style.css">
</head>
<body class="admin-delete-user">

  <h1>⚠️ Supprimer l'utilisateur « <?= htmlspecialchars($user['username']) ?> » ?</h1>

  <p>Cette action est irréversible. Êtes-vous sûr de vouloir supprimer cet utilisateur ?</p>

  <form method="post">
    <button type="submit" name="confirm" value="oui" class="confirm">Oui, supprimer</button>
    <button type="submit" name="confirm" value="non" class="cancel">Annuler</button>
  </form>

  <a href="users.php" class="back-link">← Retour à la liste des utilisateurs</a>

</body>
</html>
