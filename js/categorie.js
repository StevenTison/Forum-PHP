// JS pour la navbar
const nav = document.querySelector(".navAff");
const navBar = document.querySelector(".navBar");

nav.addEventListener('click', function (e) {
    navBar.classList.toggle("right");
});