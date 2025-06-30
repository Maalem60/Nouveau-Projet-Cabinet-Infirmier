<?php
$pageTitle = "Contact et prise de rendez-vous";
$activePage = 'contact';
$pathPrefix = ""; // on est à la racine
include 'includes/header.php';
?>

<h1>Contact et prise de rendez-vous</h1>
<main class="fade-in"><!-- contenu principal avec effet d'apparition-->
  <section id="contact">
    <!--titre de la section-->
      
      <!--introduction explicative-->
     <p>
  Pour toute demande d'information ou pour prendre rendez-vous, merci de remplir le formulaire ci-dessous, ou nous contacter par téléphone.<br><br>
  <strong>Numéro de Téléphone du Cabinet</strong> :<br>
  📞 <strong>Fixe :</strong> <a href="tel:XX.XX.XX.XX.XX">XX&nbsp;XX&nbsp;XX&nbsp;XX&nbsp;XX</a><br>
  📱 <strong>Portable :</strong> <a href="tel:XX.XX.XX.XX.XX">XX&nbsp;XX&nbsp;XX&nbsp;XX&nbsp;XX</a><br><br>
  <strong>Email</strong> :<br>
  <a href="mailto:xyz@gmail.com">xyz@gmail.com</a>
</p>

      <!--formulaire de contact-->
      <form action="envoyer.php" method="post" class="form-contact">
          <!--champs : Nom, Email, Message : -->
          <label>Nom :</label>
          <input type="text" name="nom" required>
          <label>Numéro de Téléphone :</label>
          <input type="tel" name="telephone" required>
          
          <label>Email :</label>
          <input type="email" name="email" required>
          
          <label>Message :</label>
          <textarea name="message" rows="5" required></textarea>
<!-- Champ anti-spam invisible (honeypot) -->
<!--<input type="text" name="siteweb" class="hidden-honeypot" tabindex="-1" autocomplete="off">
-->
           <!-- RGPD : case à cocher obligatoire pour consentement -->
          <div class="form-group">
  <input type="checkbox" id="rgpd" name="rgpd" required>
  <label for="rgpd">
    J'accepte la <a href="politique-confidentialite.html" target="_blank">politique de confidentialité</a>.
  </label>
</div>
<!--bouton de soumission-->      
<button type="submit">Envoyer</button>
      </form>
<!--carte géogrphique Maps integrée -->
      <div id="map">
         
          <iframe 
             src="<?= htmlspecialchars($googleMapsURL) ?>"
            width="100%" 
            height="300" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade" title="Carte Google Maps du Cabinet">
          </iframe>
      </div>
  </section>
</main>

<?php include 'includes/footer.php'; ?>
