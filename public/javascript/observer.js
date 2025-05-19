const observer = {
  init: function () {
    // Création unique de l'IntersectionObserver
    const intersectionObserver = new IntersectionObserver(
      (entries) => {
        console.log(entries);
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.remove("opacity-0", "translate-y-4");
          }
        });
        entries.forEach((entry) => {
          if (!entry.isIntersecting) {
            entry.target.classList.add("opacity-0", "translate-y-4");
          }
        });
      },
      {
        threshold: 0.5,
      }
    );
    console.log(intersectionObserver);
    // Sélection et observation des éléments
    document.querySelectorAll(".timeline-item").forEach((item) => {
      intersectionObserver.observe(item);
    });
  },
};

// Utilisation
observer.init();
