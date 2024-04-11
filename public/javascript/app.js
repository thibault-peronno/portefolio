// We develop our javascript files on object-oriented programming
const app = {
    init: function() {
        console.log('DOM loaded');
        menu.init();
        form.init();
    }
}

// To load the scripts, we listen an event : DOMContentLoaded
document.addEventListener("DOMContentLoaded", app.init);