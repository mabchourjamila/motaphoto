<!-- template-parts/modale.php -->
 <!-- affichage du modale avec le formulaire de contact -->
<dialog id="modale" class="modale animate">
    <button id="close-modale" class="modale__close">X</button>
    <div class="modale__content">
        <img class="modale__header" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/contact-header.png' ?>" alt="contact"/>
        <div class="modale__body">
        <?php
            echo do_shortcode('[contact-form-7 id="f9a9b9a" title="Contact"]');
        ?>
        </div>
    </div>
</dialog>