
<?php
require_once __DIR__ . '/includes/config.php'; // Connexion PDO centralisée


// Récupération et nettoyage des données POST
$nom = trim(filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$telephone = trim(filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_NUMBER_INT));
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$rgpd = isset($_POST['rgpd']);

// Vérification des champs obligatoires
if ($nom && $email && $message && $telephone && $rgpd) {

    // Préparation de la requête sécurisée
    $stmt = $pdo->prepare("INSERT INTO demandes_contact (nom, telephone, email, message) 
                           VALUES (:nom, :telephone, :email, :message)");
    $stmt->execute([
        ':nom'       => $nom,
        ':telephone' => $telephone,
        ':email'     => $email,
        ':message'   => $message
    ]);

    // Réponse à l'utilisateur
    echo "<p>Merci " . htmlspecialchars($nom) . ", votre demande a bien été envoyée ✅</p>";
    echo '<p><a href="index.php">Retour à l’accueil</a></p>';

} else {
    echo "<p>❌ Veuillez remplir tous les champs correctement.</p>";
}
?>
