<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class unar_slider_block extends Widget_Base {

	public function get_name() {
		return 'unar-slider-block';
	}

	public function get_title() {
		return __( 'Unar Slider Block', 'unar' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'eicon-slider-album';
	}

	public function get_categories() {
		return [ 'unar-category' ];
	}

	protected function _register_controls() {

		/*=========== POST SETTING ===========*/
		$this->start_controls_section(
			'section_unar_slider_items',
			[
				'label' => __( 'Post Setting', 'unar' ),
			]
		);

		$this->add_control(
			'slides_item',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'text' => __( 'Slider Item #1', 'unar' ),
					],
					[
						'text' => __( 'Slider Item #2', 'unar' ),
					],
				],
				'fields' => [
					[
						'name' => 'slider_img',
						'label' => __( 'Slider Image', 'unar' ),
						'type' => Controls_Manager::MEDIA,
						'label_block' => true,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
					[
						'name' => 'slider_title',
						'label' => __( 'Slider Title', 'unar' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => __( 'Your slides name.', 'unar' ),
					],
					[
						'name' => 'slider_subtitle',
						'label' => __( 'Slider Subtitle', 'unar' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => __( 'Your slides description.', 'unar' ),
					],
					[
						'name' => 'slider_btn',
						'label' => __( 'Slider Button', 'unar' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => __( 'Your slides button text.', 'unar' ),
					],
					[
						'name' => 'slides_link',
						'label' => __( 'Slider Button Link', 'unar' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
					],
					[
						'name' => 'slides_style',
						'label' => __( 'Slider Style Type (image pattern).', 'unar' ),
						'type' => Controls_Manager::SELECT,
						'label_block' => true,
						'default' => 'dark',
						'options' => [
							'dark' => __( 'Dark Image (white text)', 'unar' ),
							'light' => __( 'Light Image (black text)', 'unar' ),
						]
					],
				],
				'title_field' => '{{{ slider_title }}}',
			]
		);

		$this->end_controls_section();

		/*===========STYLE Setting=============*/

		$this->start_controls_section(
		'section_unar_slider_style',
			[
				'label' => __( 'Style Setting', 'unar' ),
			]
		);

		$this->end_controls_section();

		/*=========== LAYOUT SETTING ===========*/

		$this->start_controls_section(
			'section_unar_slider_options',
			[
				'label' => __( 'Slider Setting', 'unar' ),
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
				'label' => __( 'Slider Column Gap', 'unar' ),
				'description' => __( 'Space between carousel items.', 'unar' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '0',			
			]
		);

		$this->add_control(
			'width',
			[
				'label' => __( 'Width', 'unar' ),
				'type' => Controls_Manager::TEXT,
				'default' => '600',
				'title' => __( 'Enter some text', 'unar' ),
				'description' => __( 'Crop your image width.', 'unar' ),
			]
		);

		$this->add_control(
			'height',
			[
				'label' => __( 'Height', 'unar' ),
				'type' => Controls_Manager::TEXT,
				'default' => '600',
				'title' => __( 'Enter some text', 'unar' ),
				'description' => __( 'Crop your image height and also your post height.', 'unar' ),
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

	protected function render( $instance = [] ) {
		$instance = $this->get_settings();

		// get our input from the widget settings.
		$unar_slides_item 		= ! empty( $instance['slides_item'] ) ? $instance['slides_item'] : '';

		// Style Setting

		/*layout*/
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


		include ( plugin_dir_path(__FILE__).'tpl/slider-block.php' );



		?>


		<?php

	}

	protected function content_template() {
		?>
		<div class="slider-wrap swiper-container clearfix">
			<div class="swiper-wrapper slider-inner-content">
			<#
			if ( unar_slides_item ) {
				_.each( unar_slides_item, function( slide ) { #>
					<div class="swiper-slide slider-content">
						<# if ( slide.slider_img.url ) { #>
							<img src="{{ slide.slider_img.url }}" alt="{{ slide.slider_title }}">
						<# } #>
						<div class="slider-precontent {{ slide.slider_title }}">
							<div class="slider-content-inside">
								<# if ( slide.slider_subtitle ) { #>
								<p>{{ slide.slider_subtitle }}</p>
								# } #>
								<# if ( slide.slider_title ) { #>
								<h1>{{ slide.slider_title }}</h1>
								# } #>

								<# if ( slide.slider_btn && slide.slides_link.url ) { #>
								<div class="thebutton style3 center">
									<a href="{{ slide.slides_link.url }}" class="btn btn-slider">
										<span>{{ slide.slider_btn }}<i class="fa fa-chevron-right"></i></span>
									</a>
								</div>
								<# } #>
							</div>
						</div>
					</div>
				<#
				} );
			} #>
			</div>
		</div>
		<?php
	}

	public function render_plain_content( $instance = [] ) {}

}


Plugin::instance()->widgets_manager->register_widget_type( new unar_slider_block() );