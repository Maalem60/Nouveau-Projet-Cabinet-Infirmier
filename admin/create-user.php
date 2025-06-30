<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

require_once '../includes/config.php';

$errors = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $errors = "Ce nom d'utilisateur existe déjà.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hash]);
            $success = "Compte créé avec succès pour $username.";
        }
    } else {
        $errors = "Tous les champs sont obligatoires.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Créer un utilisateur</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body class="admin-create-user">

<h1>Créer un nouvel utilisateur</h1>

<?php if ($errors): ?>
    <p class="message error"><?= htmlspecialchars($errors) ?></p>
<?php endif; ?>

<?php if ($success): ?>
    <p class="message success"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<form method="post" action="">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" id="username" name="username" required autocomplete="username">

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required autocomplete="new-password">

    <button type="submit">Créer le compte</button>
</form>

<p class="back-link"><a href="admin-dashboard.php">← Retour au tableau de bord</a></p>

</body>
</html>
