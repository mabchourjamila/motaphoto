<?php
// Initialiser le thème
function motaphoto_theme_setup() {
    // Support des titres dynamiques
    add_theme_support('title-tag');

    // Support des images mises en avant
    add_theme_support('post-thumbnails');

    // Enregistrer un menu
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'motaphoto'),
    ));

    // Ajouter le support pour les formats de publication
    add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));
}
add_action('after_setup_theme', 'motaphoto_theme_setup');

// Enqueue des styles et scripts
function motaphoto_enqueue_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style('motaphoto-google-fonts', 'https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Poppins:wght@400;700&display=swap', false);

    // Enqueue normalize.css pour réinitialiser les styles
    wp_enqueue_style('normalize', get_template_directory_uri() . '/assets/css/normalize.css');

    // Enqueue le fichier style.css principal
    wp_enqueue_style('motaphoto-style', get_stylesheet_uri());

    // Enqueue le fichier CSS compilé à partir de SCSS
    wp_enqueue_style('motaphoto-main', get_template_directory_uri() . '/assets/css/main.css');

    // Enqueue les fichiers JavaScript
    wp_enqueue_script('motaphoto-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'motaphoto_enqueue_scripts');

// Fonction pour enregistrer les widgets
function motaphoto_widgets_init() {
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

function register_footer_menu() {
    register_nav_menu('footer-menu', __('Footer Menu'));
}
add_action('init', 'register_footer_menu');




?>
