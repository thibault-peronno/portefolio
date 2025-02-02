<div class="flex justify-center items-center">
<?php if (isset($succeeded) && !$succeeded) : ?>
        <div class="p-2 text-center text-white font-bold fixed top-10 right-10 bg-orange-600 animate-notif">
            <p><?= $message ?></p>
        </div>
    <?php endif ?>
    <section class="w-9/12 flex flex-col items-center rounded p-14 relative sm:w-max">
        <span class="absolute w-2/4 h-0.5 bg-secondary top-0 left-0 "></span>
        <span class="absolute w-2/4 rotate-90 origin-left h-0.5 bg-secondary top-0 left-0"></span>
        <img src="/assets/images/face_co.jpg" alt="" class="w-28 h-28 rounded-full">
        <form action="<?php echo $router->generate('admin-accueil'); ?>" method="post" class="flex flex-col w-full mt-10 sm:w-max">
            <label for="mail">mail</label>
            <input type="email" name="mail" id="" class="mt-2.5 mb-5 h-14 rounded border-primary border-2 p-2 sm:w-80">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="" class="mt-2.5 mb-5 h-14 rounded border-primary border-2 p-2 sm:w-80">
            <button type="submit" class="bg-btn-sec rounded p-2.5 text-center mt-3 w-full sm:w-80 text-white">Se connecter</button>
        </form>
        <span class="absolute w-2/4 h-0.5 bg-secondary bottom-0 right-0"></span>
        <span class="absolute w-2/4 origin-right rotate-90 h-0.5 bg-secondary bottom-0 right-0"></span>
    </section>
</div>