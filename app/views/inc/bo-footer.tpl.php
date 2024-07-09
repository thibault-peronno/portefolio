</main>
    <footer class="border-white border-t-2 mt-10 mb-2.5 pt-1">
      <p class="text-center text-white">Portefolio Thibault PERONNO</p>
      <div class="flex justify-center">
        <img src="/assets/images/icons/linkedin.svg" alt="" />
        <img src="/assets/images/icons/github.svg" alt="" />
      </div>
    </footer>
    <?= dump($_SERVER['REQUEST_URI']) ?>
    <script src="/javascript/app.js"></script>
    <script src="/javascript/menu.js"></script>
    <?php if(str_contains($_SERVER['REQUEST_URI'], "/bo-editer-projet") || str_contains($_SERVER['REQUEST_URI'], "/bo-editer-organisation") || str_contains($_SERVER['REQUEST_URI'], "/bo-editer-technologie") ) : ?>
    <script src="/javascript/form.js"></script>
    <?php endif ?>
    <?php if(str_contains($_SERVER['REQUEST_URI'], "/bo-ajouter-projet") || str_contains($_SERVER['REQUEST_URI'], "/bo-editer-projet") ) : ?>
    <script src="/javascript/selectTechnosForm.js"></script>
    <?php endif ?>
    <?php if($_SERVER['REQUEST_URI'] == '/bo-technos') : ?>
    <script src="/javascript/deleteLanguage.js"></script>
    <?php endif ?>
  </body>
</html>