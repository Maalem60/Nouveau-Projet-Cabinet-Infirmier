<!-- includes/header.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    // 1. Détection automatique du bon chemin relatif
    $root = $pathPrefix ?? ''; // $pathPrefix doit être défini AVANT l'inclusion de ce fichier

    // 2. Titre automatique ou personnalisé
    $title = $pageTitle ?? 'Nom du Projet';
    ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site Officiel du Cabinet Infirmier">

    <title><?= htmlspecialchars($title) ?></title>

    <link rel="stylesheet" href="<?= $root ?>CSS/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <script src="<?= $root ?>js/script.js" defer></script>

    <link rel="icon" href="<?= $root ?>favicon.ico" type="image/x-icon">
</head>
<body class="<?= $bodyClass ?? '' ?>">

<header class="navbar">
    <div class="container">
        <div class="navbar-left">
            <div class="logo">
                <img src="<?= $root ?>images/LogoInfirmier.webp" alt="Logo Cabinet Infirmier" width="100" height="100">
            </div>

            <?php if (($activePage ?? '') === 'index'): ?>
                <h1>Cabinet Infirmier Riedisheim <br> Pôle médical du Couvent</h1>
            <?php else: ?>
                <p class="site-title">Cabinet Infirmier Riedisheim <br> Pôle médical du Couvent</p>
            <?php endif; ?>
        </div>

        <nav class="navbar-right">
            <ul>
                <li><a href="<?= $root ?>index.php" class="<?= ($activePage === 'index') ? 'active' : '' ?>">Accueil</a></li>
                <li><a href="<?= $root ?>lecabinet.php" class="<?= ($activePage === 'lecabinet') ? 'active' : '' ?>">Le Cabinet</a></li>
                <li><a href="<?= $root ?>services.php" class="<?= ($activePage === 'services') ? 'active' : '' ?>">Services</a></li>
                <li><a href="<?= $root ?>infosPratique.php" class="<?= ($activePage === 'infosPratique') ? 'active' : '' ?>">Infos Pratiques</a></li>
                <li><a href="<?= $root ?>contact.php" class="<?= ($activePage === 'contact') ? 'active' : '' ?>">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>
