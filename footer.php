        </main>
        <footer class="footer">
            <div class="footer__links">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-menu',
                    'menu_class' => 'footer__menu',
                    'container' => false
                ));
                ?>
            </div>
            <div class="footer__text">Tous droits réservés</div>
            <?php get_template_part('template-parts/lightbox'); ?>
        </footer>
        <?php wp_footer(); ?>
        </body>

        </html>