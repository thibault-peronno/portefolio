const menu = {
    init: function() {
        let menuElement = document.getElementById("mobil-menu");
        menuElement.addEventListener("click", menu.handleOpenMenuClick)

        let closeMenu = document.getElementById("close-menu");
        closeMenu.addEventListener("click", menu.handleCloseMenuClick);
    },
    // Normal function
    handleOpenMenuClick: function() {
        let menu = document.getElementById("menu");
        menu.classList.remove("left-[1000px]");
        menu.classList.add("left-0");
    },

    // Arrow function
    handleCloseMenuClick : () => {
        let menu = document.getElementById("menu");
        menu.classList.remove("left-0");
        menu.classList.add("left-[1000px]");
    },
    
}