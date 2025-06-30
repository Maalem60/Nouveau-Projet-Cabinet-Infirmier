<?php
// Empêche l'accès direct au fichier
if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
    http_response_code(403);
    exit('Accès interdit');
}

// Configuration de la connexion à la base de données
$host = 'localhost';
$db   = 'nom_de_la_table';
$user = 'utilisateur';
$pass = 'mot_de_passe'; // à déplacer dans un fichier .env à terme
$charset = 'utf8mb4';

// DSN + options
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // En prod, on évite d'afficher l'erreur complète
    error_log($e->getMessage());
    die("Une erreur est survenue. Veuillez réessayer plus tard.");
}

// Définition de l'URL de base
define('BASE_URL', '/cabinet_infirmier/');
