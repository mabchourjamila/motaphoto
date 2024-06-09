<?php
get_header();

// Récupération de l'identifiant de la photo (nom) dans l'URL
$slug = get_query_var('photographies');

// Construction des critères de recherche
$args = [
    'post_type' => 'photographies',
    'name' => $slug,
    'posts_per_page' => 1
];

// Requête auprès de la base de données wordpress pour récupérer la photo correspondante
$custom_query = new WP_Query($args);

if ($custom_query->have_posts()) {
    while ($custom_query->have_posts()) {
        $custom_query->the_post();

        $reference = get_field('reference');
        $type = get_field('type');
        $annee = get_field('annee');
        $categories = wp_get_post_terms(get_the_ID(), 'categoriesphotos');
        $formats = wp_get_post_terms(get_the_ID(), 'formats');
?>

        <div class="photo-details-container">
            <!-- Zone gauche - Informations photos -->
            <div class="photo-info">
                <div class="photo-info-content">
                    <h2><?php the_title(); ?></h2>
                    <p>RÉFÉRENCE : <span class="reference"><?php echo $reference; ?></span></p>
                    <p>CATÉGORIE :
                        <?php foreach ($categories as $categorie) {
                            echo esc_html($categorie->name);
                        } ?>
                    </p>
                    <p>FORMAT :
                        <?php foreach ($formats as $format) {
                            echo esc_html($format->name);
                        }
                        ?>
                    </p>
                    <p>TYPE : <?php echo $type; ?></p>
                    <p>ANNÉE : <?php  echo $annee; ?></p>
                </div>
            </div>
            <!-- Zone droite - La photo -->
            <div class="photo-content">
                <div class="photo-content-inner">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>

<?php
    }
    wp_reset_postdata();
}
?>