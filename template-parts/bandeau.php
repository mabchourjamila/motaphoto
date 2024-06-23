<!-- template-parts/bandeau.php -->

<?php
// recupérer le champs reference de la photo
$reference = get_field('reference');
?>
<!-- Ajout du bandeau d'interactions inférieur -->
<div class="interaction-banner">
    <div class="interaction-container">
        <p>Cette photo vous intéresse ?</p>
        <button class="btn-contact" onclick="openContactModalWithReference('<?php echo $reference; ?>')">Contact</button>
    </div>
    <div class="navigation-container">
        <!-- Définition des bornes du tableau pour créer une boucle -->
        <?php
        // Requête pour obtenir le dernier post
        $args_dernier = array(
            'post_type' => 'photographies',
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'DESC',
        );

        $last_post = new WP_Query($args_dernier);

        // Requête pour obtenir le premier post
        $args_premier = array(
            'post_type' => 'photographies',
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'ASC',
        );

        $first_post = new WP_Query($args_premier);
        ?>
        <div class="navigation-arrows">
            <div class="arrow-left">
                <!-- Récupération du post précédent par date de publication ASC (comportement par defaut) -->
                <?php
                $previous_post = get_previous_post();
                // Si le post précédent existe, affichage du post précédent
                if (!empty($previous_post)) :
                    $previous_thumbnail = get_the_post_thumbnail_url($previous_post->ID, 'thumbnail');
                ?>
                    <a href="<?php echo get_permalink($previous_post); ?>">
                        <img class="arrow-img" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/previous.png' ?>" alt="Flèche de gauche" />
                    </a>
                    <div class="thumbnail-preview">
                        <img src="<?php echo $previous_thumbnail; ?>" alt="Preview" />
                    </div>
                    <!-- Si post précédent non-existant, affichage du dernier post publié -->
                <?php else :
                    $last_post = $last_post->posts[0];
                    $last_thumbnail = get_the_post_thumbnail_url($last_post->ID, 'thumbnail');
                ?>
                    <a href="<?php echo get_permalink($last_post); ?>">
                        <img class="arrow-img" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/previous.png' ?>" alt="Flèche de gauche" />
                    </a>
                    <div class="thumbnail-preview">
                        <img src="<?php echo $last_thumbnail; ?>" alt="Preview" />
                    </div>
                <?php endif; ?>
            </div>
            <div class="arrow-right">
                <!-- Récupération du post suivant par date de publication ASC (comportement naturel) -->
                <?php
                $next_post = get_next_post();
                // Si post suivant existant, affichage du post suivant
                if (!empty($next_post)) :
                    $next_thumbnail = get_the_post_thumbnail_url($next_post->ID, 'thumbnail');
                ?>
                    <a href="<?php echo get_permalink($next_post); ?>">
                        <img class="arrow-img" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/next.png' ?>" alt="Flèche de droite" />
                    </a>
                    <div class="thumbnail-right">
                        <img src="<?php echo $next_thumbnail; ?>" alt="right" />
                    </div>
                    <!-- Si post suivant non-existant, affichage du premier post publié -->
                <?php else :
                    $first_post = $first_post->posts[0];
                    $first_thumbnail = get_the_post_thumbnail_url($first_post->ID, 'thumbnail');
                ?>
                    <a href="<?php echo get_permalink($first_post); ?>">
                        <img class="arrow-img" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/next.png' ?>" alt="Flèche de droite" />
                    </a>
                    <div class="thumbnail-right">
                        <img src="<?php echo $first_thumbnail; ?>" alt="right" />
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>