<?php
// affichage du header de la page
get_header();

// affichage de la section HERO (titre + image aléatoire)
get_template_part('template-parts/hero');
?>

<div class="bloc-les-photos">
    <?php
    //affichage des filtres 
    get_template_part('template-parts/filters'); 

    //affichage de la liste des photos avec pagination (bouton voir plus)
    get_template_part('template-parts/liste-photos-pagination');     
    ?>
</div>

<?php
// affichage du footer de la page
get_footer();
?>