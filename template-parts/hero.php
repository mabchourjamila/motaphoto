<div class="hero">
    <h1>Photographe Event</h1>
    <div class="photo-random">
        <?php
        // Affichage aléatoire d'une photo
        $args = array(
            'post_type' => 'photographies',
            'posts_per_page' => 1,
            'orderby' => 'rand',
        );

        $photo_aleatoire_hero = new WP_Query($args);

        if ($photo_aleatoire_hero->have_posts()) {
            while ($photo_aleatoire_hero->have_posts()) {
                $photo_aleatoire_hero->the_post();
                 the_post_thumbnail('large');
            }
            wp_reset_postdata();
        }
        ?>
    </div>
</div>