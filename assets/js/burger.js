// Toggle mobile menu on burger click
const burgerBtn = document.querySelector(".burger-btn");
const navLinks = document.querySelector(".nav-links");

burgerBtn.addEventListener("click", (event) => {
    navLinks.classList.toggle("nav-open");
})