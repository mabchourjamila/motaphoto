<?php
// Initialiser le thème
function motaphoto_theme_setup()
{
    // Support des titres dynamiques
    add_theme_support('title-tag');

    // Support des images mises en avant
    add_theme_support('post-thumbnails');

    // Ajout d'un logo personnalisable au panel d'administration de wordpress
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Enregistrer un menu
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'motaphoto'),
        'footer-menu' => __('Footer Menu', 'motaphoto')
    ));

    // Ajouter le support pour les formats de publication
    add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));
}
add_action('after_setup_theme', 'motaphoto_theme_setup');

// Enqueue des styles et scripts
function motaphoto_enqueue_scripts()
{
    // Enqueue normalize.css pour réinitialiser les styles
    wp_enqueue_style('normalize', get_template_directory_uri() . '/assets/css/normalize.css');

    // Enqueue le fichier style.css principal
    wp_enqueue_style('motaphoto-style', get_stylesheet_uri());

    // Enqueue le fichier CSS des Font Awesome (icons)
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/fontawesome.all.min.css');

    // Enqueue le fichier CSS compilé à partir de SCSS
    wp_enqueue_style('motaphoto-main', get_template_directory_uri() . '/assets/css/main.css');

    // Enqueue les fichiers JavaScript
    wp_enqueue_script('motaphoto-script', get_template_directory_uri() . '/assets/js/main.js');

    // Enqueue les fichiers JavaScript de la page d'accueil
    if (is_home()) {
        // le JS qui gère le bouton charger-plus
        wp_enqueue_script('script-pagination', get_template_directory_uri() . '/assets/js/charger-plus.js');
        wp_localize_script('script-pagination', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'nonce'   => wp_create_nonce('ajax-nonce'),));

        // le JS qui gère les fitres de la page d'accueil
        wp_enqueue_script('script-filtres', get_template_directory_uri() . '/assets/js/filters-homepage.js', array('jquery'),);
    }

    // le JS qui gère la lightbox des photos
    wp_enqueue_script('script-lightbox', get_template_directory_uri() . '/assets/js/lightbox.js');
}
add_action('wp_enqueue_scripts', 'motaphoto_enqueue_scripts');

// Fonction pour enregistrer les widgets
function motaphoto_widgets_init()
{
    register_sidebar(array(
        'name' => __('Sidebar principale', 'motaphoto'),
        'id' => 'sidebar-1',
        'description' => __('Ajoutez des widgets ici.', 'motaphoto'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'motaphoto_widgets_init');

// Ajouter une nouvelle taille d'image
function custom_image_sizes()
{
    add_image_size('image-liste', 564, 495, true); // Nom de la taille, largeur, hauteur, crop
}
add_action('after_setup_theme', 'custom_image_sizes');

// Afficher la nouvelle taille d'image dans la bibliothèque de médias (optionnel)
function custom_sizes($sizes)
{
    return array_merge($sizes, array(
        'image-liste' => __('Image Liste'),
    ));
}
add_filter('image_size_names_choose', 'custom_sizes');

// Fonction AJAX pour l'appel ajax charger plus
function charger_plus()
{

    // Vérification du nonce avant exécution de la requête
    check_ajax_referer('ajax-nonce', 'nonce');

    $page = $_POST['page'];
    $ordreTriage = $_POST['order'];
    $category = $_POST['category'] ?? 'all';
    $format = $_POST['format'] ?? 'all';

    $tax_query = array('relation' => 'AND');

    // Si une catégorie est présente et n'est pas égale à all
    if (isset($_POST['category']) && $_POST['category'] !== 'all') {
        $category = $_POST['category'];
        $tax_query[] = array(
            'taxonomy' => 'categoriesphotos',
            'field' => 'slug',
            'terms' => $category,
        );
    }

    // Si un format est présent et n'est pas égal à all
    if (isset($_POST['format']) && $_POST['format'] !== 'all') {
        $format = $_POST['format'];
        $tax_query[] = array(
            'taxonomy' => 'formats',
            'field' => 'slug',
            'terms' => $format,
        );
    }

    $args = array(
        'post_type' => 'photographies',
        'posts_per_page' => 8,
        'orderby' => 'date',
        'order' => $ordreTriage,
        'paged' => $page,
        'tax_query' => $tax_query,
    );

    $photo_query = new WP_Query($args);

    if ($photo_query->have_posts()) {
        while ($photo_query->have_posts()) {
            $photo_query->the_post();
            get_template_part('template-parts/photo-bloc');
        }
        wp_reset_postdata();
    }

    wp_die();
}

add_action('wp_ajax_charger_plus', 'charger_plus');
add_action('wp_ajax_nopriv_charger_plus', 'charger_plus');


// Fonction AJAX pour récupérer les photos filtrées
function filtrer_photos()
{

    // Vérification du nonce avant exécution de la requête
    check_ajax_referer('ajax-nonce', 'nonce');

    $tax_query = array('relation' => 'AND');
    $order = $_POST['order'] ?? 'ASC';

    // Si une catégorie est présente et n'est pas égale à all
    if (isset($_POST['category']) && $_POST['category'] !== 'all') {
        $category = $_POST['category'];
        $tax_query[] = array(
            'taxonomy' => 'categoriesphotos',
            'field' => 'slug',
            'terms' => $category,
        );
    }

    // Si un format est présent et n'est pas égal à all
    if (isset($_POST['format']) && $_POST['format'] !== 'all') {
        $format = $_POST['format'];
        $tax_query[] = array(
            'taxonomy' => 'formats',
            'field' => 'slug',
            'terms' => $format,
        );
    }

    $args = array(
        'post_type' => 'photographies',
        'posts_per_page' => 8,
        'orderby' => 'date',
        'order' => $order,
        'paged' => 1,
        'tax_query' => $tax_query,
    );

    $photo_query = new WP_Query($args);

    // Stockage du résultat en tampon temporairement
    ob_start();

    // Définition de la structure d'affichage des nouveaux éléments
    if ($photo_query->have_posts()) {
        while ($photo_query->have_posts()) {
            $photo_query->the_post();
            get_template_part('template-parts/photo-bloc');
        }
        wp_reset_postdata();
    } else {
        echo 'Aucune photo trouvée.';
    }

    // Récupération des informations en tampon dans une variable
    $output = ob_get_clean();

    // Affichage de la variable
    echo $output;

    wp_die();
}

add_action('wp_ajax_filtrer_photos', 'filtrer_photos');
add_action('wp_ajax_nopriv_filtrer_photos', 'filtrer_photos');
