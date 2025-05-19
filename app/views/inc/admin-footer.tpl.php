</main>
    <footer class="border-white border-t-2 mt-10 mb-2.5 pt-1">
      <p class="text-center text-white">Portefolio Thibault PERONNO</p>
    </footer>
    <?= dump($_SERVER['REQUEST_URI']) ?>
    <script src="/javascript/app.js"></script>
    <script src="/javascript/menu.js"></script>
    <?php if(str_contains($_SERVER['REQUEST_URI'], "/admin-editer-projet") || str_contains($_SERVER['REQUEST_URI'], "/admin-editer-organisation") || str_contains($_SERVER['REQUEST_URI'], "/admin-editer-technologie") ) : ?>
    <script src="/javascript/form.js"></script>
    <?php endif ?>
    <?php if(str_contains($_SERVER['REQUEST_URI'], "/admin-ajouter-projet") || str_contains($_SERVER['REQUEST_URI'], "/admin-editer-projet") ) : ?>
    <script src="/javascript/selectTechnosForm.js"></script>
    <?php endif ?>
    <?php if($_SERVER['REQUEST_URI'] == '/admin-technos') : ?>
    <script src="/javascript/deleteLanguage.js"></script>
    <?php endif ?>
  </body>
</html>