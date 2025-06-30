<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

require_once '../includes/config.php';

$stmt = $pdo->query("SELECT * FROM users ORDER BY id DESC");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Gestion des utilisateurs</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      max-width: 900px;
      margin: 40px auto;
      padding: 0 20px;
      background-color: #f9f9f9;
      color: #333;
    }
    h2 {
      text-align: center;
      color: #2c3e50;
    }
    p {
      text-align: center;
      margin-bottom: 20px;
    }
    p a {
      background-color: #3498db;
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }
    p a:hover {
      background-color: #2980b9;
    }
    table {
      border-collapse: collapse;
      width: 100%;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      background: white;
      border-radius: 8px;
      overflow: hidden;
    }
    th, td {
      padding: 12px 15px;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }
    th {
      background-color: #3498db;
      color: white;
      font-weight: bold;
    }
    tr:hover {
      background-color: #f1faff;
    }
    td:last-child a {
      color: #e74c3c;
      text-decoration: none;
      font-weight: bold;
      transition: color 0.3s ease;
    }
    td:last-child a:hover {
      color: #c0392b;
      text-decoration: underline;
    }
    p.back-link {
      text-align: center;
      margin-top: 30px;
    }
    p.back-link a {
      color: #3498db;
      text-decoration: none;
      font-weight: bold;
      transition: text-decoration 0.3s ease;
    }
    p.back-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<h2>Liste des utilisateurs</h2>

<p><a href="register.php">Créer un nouvel utilisateur</a></p>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Nom d'utilisateur</th>
      <th>Créé le</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
      <tr>
        <td><?= htmlspecialchars($user['id']) ?></td>
        <td><?= htmlspecialchars($user['username']) ?></td>
        <td><?= htmlspecialchars($user['created_at']) ?></td>
        <td>
          <a href="delete-user.php?id=<?= $user['id'] ?>" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<p class="back-link"><a href="admin-dashboard.php">← Retour au tableau de bord</a></p>

</body>
</html>
