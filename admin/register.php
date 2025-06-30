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
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");

        try {
            $stmt->execute([$username, $hash]);
            $success = "Compte créé avec succès pour $username";
        } catch (PDOException $e) {
            $errors = "Erreur : ce nom d'utilisateur existe déjà.";
        }
    } else {
        $errors = "Remplir tous les champs";
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
<body class="admin-register">

<h1>Créer un nouvel utilisateur</h1>


<?php if ($errors): ?>
  <p class="message error"><?= htmlspecialchars($errors) ?></p>
<?php endif; ?>

<?php if ($success): ?>
  <p class="message success"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<form method="post" action="">
  <label for="username">Nom d'utilisateur :</label>
  <input type="text" id="username" name="username" required autofocus />

  <label for="password">Mot de passe :</label>
  <input type="password" id="password" name="password" required />

  <button type="submit">Créer</button>
</form>

<p class="back-link"><a href="admin-demandes.php">← Retour</a></p>

</body>
</html>
