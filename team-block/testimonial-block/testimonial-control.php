<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class unar_testimonial_block extends Widget_Base {

	public function get_name() {
		return 'unar-testimonial-block';
	}

	public function get_title() {
		return __( 'Unar Testimonial Block', 'unar' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_categories() {
		return [ 'unar-category' ];
	}

	protected function _register_controls() {


		/*===========GENERAL CONTROL=============*/

		$this->start_controls_section(
			'section_unar_testimonial_block',
			[
				'label' => __( 'Testimonial Setting', 'unar' ),
			]
		);

		$this->add_control(
			'testi_item',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'text' => __( 'Testimonial Item #1', 'unar' ),
					],
					[
						'text' => __( 'Testimonial Item #2', 'unar' ),
					],
				],
				'fields' => [
					[
						'name' => 'testi_text',
						'label' => __( 'Testimonial Text', 'unar' ),
						'type' => Controls_Manager::TEXTAREA,
						'label_block' => true,
						'default' => __( 'Your client quotes.', 'unar' ),
					],
					[
						'name' => 'testi_author',
						'label' => __( 'Testimonial Author', 'unar' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => __( 'Your client name.', 'unar' ),
					],
					[
						'name' => 'testi_author_job',
						'label' => __( 'Author Job', 'unar' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => __( 'Your client job.', 'unar' ),
					],
					[
						'name' => 'author_tesi_img',
						'label' => __( 'Author Image', 'unar' ),
						'type' => Controls_Manager::MEDIA,
						'label_block' => true,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
				],
				'title_field' => '{{{ testi_author }}}',
			]
		);

		$this->end_controls_section();

		
		/*===========SLIDE=============*/

		$this->start_controls_section(
			'section_unar_carousel_options',
			[
				'label' => __( 'Carousel Setting', 'unar' ),
			]
		);

		$this->add_control(
			'choose_column',
			[
				'label' => __( 'Column', 'unar' ),
				'type' => Controls_Manager::SELECT,
				'default' => 3,
				'options' => [
					'auto' => __( 'auto', 'unar' ),
					1 => __( '1', 'unar' ),
					2 => __( '2', 'unar' ),
					3 => __( '3', 'unar' ),
					4 => __( '4', 'unar' ),
					5 => __( '5', 'unar' ),
				],
				'description' => __( 'Number of slides per view (slides visible at the same time on slider&#39;s container)', 'unar' ),
			]
		);

		$this->add_control(
			'choose_column_mobile',
			[
				'label' => __( 'Column (on mobile)', 'unar' ),
				'type' => Controls_Manager::SELECT,
				'default' => 1,
				'options' => [
					1 => __( '1', 'unar' ),
					2 => __( '2', 'unar' ),
					3 => __( '3', 'unar' ),
					4 => __( '4', 'unar' ),
					5 => __( '5', 'unar' ),
				],
				'description' => __( 'Number of slides per view (slides visible at the same time on slider&#39;s container)', 'unar' ),
			]
		);

		$this->add_control(
			'column_gap',
			[
				'label' => __( 'Carousel Column Gap', 'unar' ),
				'description' => __( 'Space between carousel items.', 'unar' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '0',			
			]
		);

		/* navigation */
		$this->add_control(
			'navigation',
			[
				'label' => __( 'Navigation', 'unar' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => __( 'None', 'unar' ),
					'arrows-dots' => __( 'Arrows and Dots', 'unar' ),
					'arrows' => __( 'Arrows', 'unar' ),
					'dots' => __( 'Dots', 'unar' ),
				],
				'description' => __( 'Select your navigation type.', 'unar' ),
			]
		);

		$this->add_control(
			'navigation_arrows_color',
			[
				'label' => __( 'Navigation Arrows Color', 'unar' ),
				'type' => Controls_Manager::COLOR,	
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next:before, .swiper-button-prev:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows-dots', 'arrows' ],
				],
			]
		);

		$this->add_control(
			'navigation_dots_color',
			[
				'label' => __( 'Navigation Dots Color', 'unar' ),
				'type' => Controls_Manager::COLOR,	
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet-active' => 'background: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows-dots', 'dots' ],
				],
			]
		);

		/* auto opt */
		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'unar' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
				'prefix_class' => 'slide-autoplay-',
				'label_on' => 'Use',
				'label_off' => 'No',
				'return_value' => 'use',
				'description' => __( 'Make your slider auto play.', 'unar' ),
			]
		);

		$this->add_control(
			'autoplay_ms',
			[
				'label' => __( 'Next Slide On', 'unar' ),
				'description' => __( 'Delay between transitions (in ms). If this parameter is not specified, auto play will be disabled.', 'unar' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '1500',
				'condition' => [
					'autoplay' => 'use',
				],			
			]
		);

		$this->add_control(
			'auto_loop',
			[
				'label' => __( 'Slides Loop', 'unar' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
				'prefix_class' => 'slide-loop-',
				'label_on' => 'Use',
				'label_off' => 'No',
				'return_value' => 'use',
				'description' => __( 'Make your slider loop your items.', 'unar' ),
			]
		);

		/* misc */
		$this->add_control(
			'keyboard_nav',
			[
				'label' => __( 'Keyboard Control', 'unar' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
				'prefix_class' => 'slide-keyboard-',
				'label_on' => 'Use',
				'label_off' => 'No',
				'return_value' => 'use',
				'description' => __( 'Allow to navigate the slide using keyboard arrows.', 'unar' ),
			]
		);

		$this->add_control(
			'centered_slide',
			[
				'label' => __( 'Centered Slides', 'unar' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
				'prefix_class' => 'slide-centered-',
				'label_on' => 'Use',
				'label_off' => 'No',
				'return_value' => 'use',
				'description' => __( 'Allow to make centered slides.', 'unar' ),
			]
		);

		$this->add_control(
			'effect_type',
			[
				'label' => __( 'Effect Type', 'unar' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide' => __( 'Slide', 'unar' ),
					'fade' => __( 'Fade', 'unar' ),
					'cube' => __( 'Cube', 'unar' ),
					'coverflow' => __( 'Coverflow', 'unar' ),
					'flip' => __( 'Flip', 'unar' ),
				],
				'description' => __( 'Select your slider slide effect.', 'unar' ),
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$instance = $this->get_settings();

		$testimonials 		= ! empty( $instance['testi_item'] ) ? $instance['testi_item'] : '';
		$testi_text 		= ! empty( $testimonial['testi_text'] ) ? $testimonial['testi_text'] : 'Your client quotes.';
		$testi_author 		= ! empty( $testimonial['testi_author'] ) ? $testimonial['testi_author'] : 'Your client name.';
		$testi_author_job 	= ! empty( $testimonial['testi_author_job'] ) ? $testimonial['testi_author_job'] : 'Your client job.';
		

		/* ANIMATION SETTING */
		$choose_column 			= ! empty( $instance['choose_column'] ) ? $instance['choose_column'] : 3;
		$choose_column_mobile 	= ! empty( $instance['choose_column_mobile'] ) ? $instance['choose_column_mobile'] : 1;	
		$column_gap 			= ! empty( $instance['column_gap'] ) ? $instance['column_gap'] : '0';		
		
		$navigation 	=  $instance['navigation'];
		$autoplay 		=  $instance['autoplay'];
		$autoplay_ms 	= ! empty( $instance['autoplay_ms'] ) ? (int)$instance['autoplay_ms'] : 1500;
		$auto_loop 		=  $instance['auto_loop'];
		$keyboard_nav	=  $instance['keyboard_nav'];
		$centered_slide	=  $instance['centered_slide'];
		$effect_type 	= ! empty( $instance['effect_type'] ) ? $instance['effect_type'] : 'Slide';

		include ( plugin_dir_path(__FILE__).'tpl/testimonial-block.php' );



		?>

		<?php

	}

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new unar_testimonial_block() );