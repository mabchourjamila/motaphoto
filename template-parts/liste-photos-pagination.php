<div class="affichage-des-photos">
    <div class="zone-les-photos">
        <!-- Création d'une loop pour afficher toutes les photos -->
        <?php
        $args = array(
            'post_type' => 'photographies',
            'posts_per_page' => 8,
            'orderby' => 'date',
            'order' => 'ASC',
            'paged' => 1,
        );

        $photo_query = new WP_Query($args);

        if ($photo_query->have_posts()) {
            while ($photo_query->have_posts()) {
                $photo_query->the_post();
                get_template_part('template-parts/photo-bloc');
            }
            wp_reset_postdata();
        } else {
            echo 'Aucune photo trouvée.';
        }
        ?>
    </div>
</div>
<!-- Affichage du bouton Charger plus -->
<div class="bouton-accueil">
    <button id="charger-plus" class="voir-plus">Charger plus</button>
</div>