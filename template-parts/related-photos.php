<!-- template-parts/related-photos.php -->

<!-- Dernière partie de page - Photos apparentées -->
<div class="related-photos">
	<h3>Vous aimerez aussi</h3>
	<div class="related-photos-container">
		<div class="related-photos-grid">
			<?php
//var_dump(get_the_ID());
				// Récupération de la catégorie de la photo actuelle
				$categories = wp_get_post_terms(get_the_ID(), 'categoriesphotos');
//var_dump($categories);
				if ($categories && !is_wp_error($categories)) {
					$ID_categories = wp_list_pluck($categories, 'term_id');
            
					// Récupération de deux photos de la même catégorie aléatoirement, en excluant la photo affichée au dessus
					$photos_similaires = new WP_Query(array(
						'post_type' => 'photographies',
						'posts_per_page' => 2,
						'post__not_in' => array(get_the_ID()),
						'orderby' => 'rand',
						'tax_query' => array(
							array(
								'taxonomy' => 'categoriesphotos',
								'field' => 'id',
								'terms' => $ID_categories,
							),
						),
					));
//var_dump($photos_similaires);
					if ($photos_similaires->have_posts()) {
						while ($photos_similaires->have_posts()) {
							$photos_similaires->the_post();
                            // Affichage de la photo similaire gérée via un template part
							get_template_part('template-parts/photo-bloc');
						}
						wp_reset_postdata();
					} else {
						// Affichage d'un message si aucune photo similaire n'est trouvée dans la même catégorie
						echo "Aucune photo similaire pour le moment";
					}
				}
			?>
		</div>
		<a href="<?php echo esc_url(home_url('/')); ?>"><button class="btn-all-photos">Toutes les photos</button></a>
	</div>
</div>

<?php get_footer(); ?>
