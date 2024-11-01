<div class="portfolio-block">			

	<div id="foliowrap" class="portfolio-list isotope-container clearfix">

	<?php
		$porto_block = array(
			'post_type'          => 'unar-portfolio',
			'post_status'        => 'publish',
			'posts_per_page'	=> $post_per_page,
			'ignore_sticky_posts' => true,
			'offset' => $offset,
			'orderby' => $orderby

		);

		$portoblock_loop = new WP_Query($porto_block);
		if ($portoblock_loop->have_posts()) : while($portoblock_loop->have_posts()) : $portoblock_loop->the_post(); 

		global $post;
		$category_masonry_block = get_the_terms($post->ID, 'portfolio-category');
				foreach($category_masonry_block as $term){
				$category_name = $term->name;
				$category_slug = $term->slug;
		} ?>
			
		<div class="foliobox col-md-<?php echo esc_attr($choose_column); ?> col-xs-12">
			<a class="incontent-effect" href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(); ?>
				<div class="caption">
					<div class="vertical-center">
						<h4><?php the_title(); ?></h4>
						<div class="bord white"></div>
						<h6 class="no-transform"><?php echo sanitize_text_field( $category_name ); ?></h6>
					</div>
				</div>
			</a>
		</div><!-- end foliobox -->

		<?php endwhile; wp_reset_postdata(); endif; ?>

	</div>
</div><!-- Portfolio -->