<?php get_header(); ?>

<main>
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header>
                    <h1><?php the_title(); ?></h1>
                    <p>Publié le <?php the_time('j F Y'); ?> par <?php the_author(); ?></p>
                </header>
                <div class="content">
                    <?php the_content(); ?>
                </div>
                <footer>
                    <p>Catégories : <?php the_category(', '); ?></p>
                    <p><?php the_tags(); ?></p>
                </footer>
            </article>
            <?php
        endwhile;
    else :
        echo '<p>Aucun article trouvé.</p>';
    endif;
    ?>
</main>

<?php get_footer(); ?>
