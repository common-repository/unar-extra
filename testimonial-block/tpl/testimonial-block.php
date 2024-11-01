<div class="testimonial-wrap swiper-container clearfix">
	<div class="testimonial-item swiper-wrapper">

		<?php foreach ( $testimonials as $testimonial ) : ?>

				<div class="swiper-slide item">
					<div class="context">
						<div class="inner">
							<blockquote><p><?php echo balancetags($testimonial['testi_text']); ?></p></blockquote>
							<figure class="ava">
								<img src="<?php echo esc_url($testimonial['author_tesi_img']['url']); ?>" alt="<?php echo sanitize_text_field($testimonial['testi_author']); ?>">
							</figure>
							<p class="who"><?php if(!empty($testimonial['testi_author'])){ ?><span><?php echo sanitize_text_field($testimonial['testi_author']); ?></span>, 
							<?php } ?>
						<?php 										
							if(!empty($testimonial['testi_author_job'])){
								echo sanitize_text_field( $testimonial['testi_author_job'] );
							}  ?></p>
						</div>
					</div>
				</div><!-- end item -->

		<?php endforeach; ?>

	</div>

	<?php if($navigation != 'none') {
		if($navigation == 'dots') { ?>
		<!-- Add Pagination -->
		<div class="swiper-pagination"></div>
		<?php }
		elseif($navigation == 'arrows') { ?>
		<!-- Add Arrows -->
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
		<?php }
		else { ?>
		<!-- Add Pagination -->
		<div class="swiper-pagination"></div>
		<!-- Add Arrows -->
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
		<?php }
	} ?>
	
</div><!-- end carousel -->

<script type="text/javascript">
jQuery(document).ready(function() {
	var swiper = new Swiper('.testimonial-wrap', {
			slidesPerView: '<?php echo $choose_column; ?>',
		<?php if($navigation == 'dots' || $navigation == 'arrows-dots') { ?>
			pagination: '.swiper-pagination',
			paginationClickable: true,
		<?php }
		if($navigation == 'arrows' || $navigation == 'arrows-dots') { ?>
			nextButton: '.swiper-button-next',
			prevButton: '.swiper-button-prev',
		<?php } ?>
			spaceBetween: <?php echo $column_gap; ?>,
		<?php if($autoplay == 'use') { ?>
			autoplayDisableOnInteraction: false,
			autoplay: <?php echo $autoplay_ms; ?>,
		<?php } ?>
		<?php if($auto_loop == 'use') { ?>
			loop: true,
		<?php } ?>
		<?php if($keyboard_nav == 'use') { ?>
			keyboardControl: true,
		<?php } ?>
			effect: '<?php echo $effect_type; ?>',
			breakpoints: {
			    // when window width is <= 640px
			    768: {
			      slidesPerView: <?php echo $choose_column_mobile; ?>,
			    }
			},
		<?php if($centered_slide == 'use') { ?>
        	centeredSlides: true,
        <?php } ?>
	});
});
</script>