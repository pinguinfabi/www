const navbar = document.getElementById("navbar");
const main_container = document.getElementById("main_container");
const footer = document.getElementById("footer_container");

main_container.style.height = ((window.innerHeight - navbar.clientHeight) - footer.clientHeight) + "px";