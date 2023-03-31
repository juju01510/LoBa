const menuBurger = document.querySelector(".containner")
const navLinks = document.querySelector(".navlinks")

menuBurger.addEventListener("click",() => {navLinks.classList.toggle('mobile-menu');
    if (navLinks.classList.contains('mobile-menu')) {
        // Empêcher le défilement de la page
        document.body.style.overflow = 'hidden';
    } else {
        // Activer le défilement de la page
        document.body.style.overflow = 'auto';
    }
});