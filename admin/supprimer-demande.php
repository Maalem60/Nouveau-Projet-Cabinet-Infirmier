<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

require_once '../includes/config.php'; // Utiliser la config centralisée PDO

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    die('ID invalide');
}

$stmt = $pdo->prepare("DELETE FROM demandes_contact WHERE id = ?");
$stmt->execute([$id]);

header('Location: admin-demandes.php');
exit;
?>