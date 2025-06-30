document.addEventListener("DOMContentLoaded", function () {
  // --- Gestion du menu hamburger ---
  const toggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.navbar-bottom');

  if (toggle && nav) {
    toggle.addEventListener('click', () => {
      nav.classList.toggle('active');
    });
  }

  // --- Gestion du formulaire de contact avec SweetAlert ---
  const form = document.querySelector(".form-contact");

  if (form) {
    form.addEventListener("submit", function (event) {
      event.preventDefault(); // on empêche l'envoi immédiat

      Swal.fire({
        title: "Envoyer le message ?",
        text: "Voulez-vous vraiment confirmer l'envoi de ce message ?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "✅ Oui, envoyer",
        cancelButtonText: "❌ Annuler",
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit(); // si l'utilisateur confirme, on envoie le formulaire
        }
      });
    });
  }
});
