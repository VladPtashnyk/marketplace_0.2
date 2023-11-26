const menuButton = document.getElementById("user-menu-button");
const dropdownMenu = document.querySelector("[aria-labelledby='user-menu-button']");

menuButton.addEventListener("click", function() {
    dropdownMenu.classList.remove("hidden");
});

document.addEventListener("click", function(event) {
    if (!menuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.classList.add("hidden");
    }
});
