const menuBurger = document.querySelector(".containner")
const navLinks = document.querySelector(".navlinks")

menuBurger.addEventListener("click",() => {navLinks.classList.toggle('mobile-menu')})