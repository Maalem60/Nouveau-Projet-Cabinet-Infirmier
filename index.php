<?php $activePage = 'index'; ?><!--declaration d'une variable pour indiquer la page active-->
<?php
$pageTitle = "Accueil";
$activePage = 'index';
$pathPrefix = ""; // on est à la racine
include 'includes/header.php';
?>


<main class="bloc-image-seul fade-in"><!--ébut du contenu principal avec animation d'apparition (fade-in)-->
 <img src="images/Cabinet_Infirmier.webp" alt="Photo du Cabinet Infirmier"width="1200" height="800" loading="lazy">
  
  <!-- introduction de la page accueil dans index.php-->
<section id="Accueil" class="fade-in"><!--section page accueil avec animation d'apparititon-->
    <h2>Titre principal</h2>
    <p class="fade-in">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum aut eveniet consequatur architecto modi ipsum, nisi autem, laborum maxime sapiente optio quia possimus officiis assumenda impedit id odio quos. Dignissimos. <b>xyz</b><br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos fugiat animi quas perferendis officia dolores modi natus maxime. Ab harum culpa commodi est provident rem saepe dolore minus possimus pariatur?</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci, consequatur. Error sunt maxime possimus cumque ratione accusamus pariatur dignissimos eligendi maiores totam voluptatibus, architecto culpa quaerat laboriosam autem corrupti perferendis?</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure sunt eum id libero, deleniti, eos accusantium corporis atque tempora minus dolorum a consectetur molestias quia nesciunt, exercitationem unde vero modi?</a></p>
</section>
</main>

<?php include 'includes/footer.php'; ?><!--inclusion du footer commun à toutes les pages.-->
