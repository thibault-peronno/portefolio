// We develop our javascript files on object-oriented programming
const app = {
  init: function () {
    console.log("const app DOM loaded");
    menu.init();
    if (
      window.location.pathname.includes("admin-ajouter-projet") ||
      window.location.pathname.includes("admin-editer-projet")
    ) {
      selectTechnosForm.init();
    }
    if (
      window.location.pathname.includes("admin-editer-projet") ||
      window.location.pathname.includes("admin-editer-organisation") ||
      window.location.pathname.includes("admin-editer-technologie")
    ) {
      form.init();
    }
    if (window.location.pathname === "/admin-technos") {
      deleteLanguage.init();
    }
  },
};

// To load the scripts, we listen an event : DOMContentLoaded
document.addEventListener("DOMContentLoaded", app.init);
