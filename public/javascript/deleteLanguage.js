const deleteLanguage = {
  init: function () {
    let btnDeleteLanguage = document.getElementById("deleteLanguages");
    const labelId = btnDeleteLanguage.dataset.labelId;

    btnDeleteLanguage.addEventListener("click", () =>
      deleteLanguage.handlerDeleteLanguage(labelId)
    );
  },

  handlerDeleteLanguage: async function (labelId) {
    console.log("delete language", labelId);

    const response = await fetch(
      `http://localhost:8000/admin-delete--technos/${labelId}`,
      {
        method: "DELETE",
        headers: {
          "Content-Type": "application/json",
        },
      }
    );
  },
};
