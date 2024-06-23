<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photographe</title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header>
        <nav class="navbar dark-mode" role="navigation">
            <div class="navbar__logo">
                <a href="<?php echo home_url(); ?>">
                <?php the_custom_logo() ?>
            </a>
            </div>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'navbar__links',
            ));
            ?>
            <button class="burger">
                <span class="bar"></span>
            </button>
        </nav>
        <?php get_template_part('/template-parts/modale'); ?>
    </header>
    <main>