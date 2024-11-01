<div class="thetitle">
	
	<?php if($head_use_subtitle == 'on') { ?>
		<span class="text wow fadeIn animated" data-wow-delay="0.2s">
			<?php echo sanitize_text_field( $the_subtitle ); ?>
		</span>
	<?php } ?>
	
	<<?php echo sanitize_text_field($title_size); ?> class="title wow fadeIn animated" data-wow-delay="0.2s">
		<?php echo sanitize_text_field( $the_title ); ?>
	</<?php echo sanitize_text_field($title_size); ?>>
	
	<div class="bord black wow fadeIn animated" data-wow-delay="0.2s"></div>

</div>