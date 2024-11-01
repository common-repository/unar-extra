<div class="slider-wrap swiper-container clearfix">
	<div class="swiper-wrapper slider-inner-content">

	<?php foreach ( $unar_slides_item as $slide ) :

	$unar_slide_style = $slide['slider_title'];
	$unar_slider_img = $slide['slider_img']['url'];
	$unar_slide_title = $slide['slider_title'];
	$unar_slide_subtitle = $slide['slider_subtitle'];
	$unar_slide_link = $slide['slides_link']['url'];
	$unar_slide_btn = $slide['slider_btn']; ?>

	<div class="swiper-slide slider-content">
		
		<img src="<?php echo esc_url($unar_slider_img); ?>" alt="<?php echo sanitize_text_field($unar_slide_title); ?>">

		<div class="slider-precontent <?php echo esc_attr($slide['slides_style']); ?>">
			<div class="slider-content-inside">
				<p><?php echo sanitize_text_field($unar_slide_subtitle); ?></p>
				<h1><?php echo sanitize_text_field($unar_slide_title); ?></h1>

				<div class="thebutton style3 center">
					<a href="<?php echo esc_url($unar_slide_link); ?>" class="btn btn-slider">
						<span><?php echo sanitize_text_field($unar_slide_btn); ?><i class="fa fa-chevron-right"></i></span>
					</a>
				</div>
			</div>
		</div>
		
	</div>

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
	
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
	var swiper = new Swiper('.slider-wrap', {
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