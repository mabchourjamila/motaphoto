<?php
/*
Theme Name: Motaphoto
Theme URI: http://motaphoto.com
Author: Jamila BOUMEHDI
Author URI: http://jamila-boumehdi.com
Description: Thème WordPress pour la photographie Nathalie MOTA.
Version: 1.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: motaphoto
*/
get_header(); ?>
<main>
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            the_title('<h2>', '</h2>');
            the_content();
        endwhile;
    else :
        echo '<p>Aucun contenu trouvé.</p>';
    endif;
    ?>
</main>
<?php get_footer(); ?>
