<!-- template-parts/photo-bloc.php -->
<?php
// Récupération des informations de la photo
$titre_post = get_the_title();
$titre_slug = sanitize_title($titre_post);
$lien_post = get_site_url() . '/photographies/' . $titre_slug;
$date_post = get_the_date('Y');
$reference_photo = get_field('reference');

// Récupération du format de la photo et stockage pour filtrage
$formats = get_the_terms(get_the_ID(), 'formats');
if ($formats && !is_wp_error($formats)) {
    $noms_formats = array();
    foreach ($formats as $format) {
        $noms_formats[] = $format->name;
    }
    $liste_formats = join(', ', $noms_formats);
}

// Récupération de la catégorie de la photo et stockage pour filtrage
$categories = get_the_terms(get_the_ID(), 'categoriesphotos');
if ($categories && !is_wp_error($categories)) {
    $noms_categories = array();
    foreach ($categories as $categorie) {
        $noms_categories[] = $categorie->name;
    }
    $liste_categories = join(', ', $noms_categories);
}
?>

<!-- Affichage du bloc photo -->
<div class="bloc-photo">
    <div class="photo-link">
        <a href="<?php echo esc_url($lien_post); ?>"><?php echo $titre_post; ?></a>
    </div>
    <div class="photo-content">
        <?php the_post_thumbnail('image-liste'); ?>
    </div>
    <div class="photo-hover">
        <div class="hover-content">
            <div class="hover-top">
                <i class="fa-solid fa-expand full-screen" style="color: #ffffff;"></i>
            </div>
            <div class="hover-middle">
                <a href="<?php echo esc_url($lien_post); ?>">
                    <i class="fa-regular fa-eye eye" style="color: #ffffff;"></i>
                </a>
            </div>
            <div class="hover-bottom">
                <div class="reference">
                    <?php echo esc_html($reference_photo); ?>
                </div>
                <div class="categories">
                    <?php echo esc_html($liste_categories); ?>
                </div>
            </div>
        </div>
    </div>
</div>