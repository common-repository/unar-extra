<div class="team-block clearfix">

    <?php foreach ( $teams as $team ) : ?>

	<div class="team-box wow fadeIn col-md-<?php echo esc_attr($choose_column); ?>" data-wow-delay="0.2s">
		<div class="teamimg">
			<figure class="team-imgbox wow zoomIn">
					<img src="<?php echo esc_url($team['team_img']['url']); ?>" alt="<?php echo sanitize_text_field($team['team_name']); ?>">
					<figcaption>
						<div class="team-caption">
							<?php if(!empty($team['team_name'])) { ?>
								<h4><?php echo sanitize_text_field($team['team_name']); ?></h4>
							<?php }
							if(!empty($team['team_job'])) {?>
							<div class="bord white"></div>
							<span class="team-tag"><?php echo sanitize_text_field( $team['team_job'] ); ?></span>
							<?php } ?>
						</div>
					</figcaption>
			</figure>
		</div>

			<div class="team-social wow fadeIn clearfix">
				<?php if(!empty($team['team_facebook'])) { ?>
				<a class="facebook" href="<?php echo esc_url( $team['team_facebook']['url'] ); ?>" title="Facebook"><i class="fa fa-facebook"></i></a>
				<?php }
				if(!empty($team['team_twitter'])) {?>
				<a class="twitter" href="<?php echo esc_url( $team['team_twitter']['url'] ); ?>" title="Twitter"><i class="fa fa-twitter"></i></a>
				<?php }
				if(!empty($team['team_dribbble'])) {?>
				<a class="dribble" href="<?php echo esc_url( $team['team_dribbble']['url'] ); ?>" title="Dribble"><i class="fa fa-dribbble"></i></a>
				<?php }
				if(!empty($team['team_instagram'])) {?>
				<a class="instagram" href="<?php echo esc_url( $team['team_instagram']['url'] ); ?>" title="Instagram"><i class="fa fa-instagram"></i></a>
				<?php } ?>
			</div>
			
		</div>	

    <?php endforeach; ?>

</div>