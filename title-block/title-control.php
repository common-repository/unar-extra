<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class unar_head_title extends Widget_Base {

	public function get_name() {
		return 'unar-head-title';
	}

	public function get_title() {
		return __( 'Unar Head Title', 'unar' );
	}

	public function get_icon() {
		return 'eicon-banner';
	}

	public function get_categories() {
		return [ 'unar-category' ];
	}

	protected function _register_controls() {

		/*----- Style Control -----*/

		$this->start_controls_section(
			'section_unar_head_title',
			[
				'label' => __( 'General Settings', 'unar' ),
			]
		);

		$this->add_control(
			'title_size',
			[
				'label' => __( 'Title Size', 'unar' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => __( 'H1', 'unar' ),
					'h2' => __( 'H2', 'unar' ),
					'h3' => __( 'H3', 'unar' ),
					'h4' => __( 'H4', 'unar' ),
					'h5' => __( 'H5', 'unar' ),
					'h6' => __( 'H6', 'unar' ),
					'div' => __( 'div', 'unar' ),
					'span' => __( 'span', 'unar' ),
					'p' => __( 'p', 'unar' ),
				],
				'default' => 'h2',
			]
		);

		$this->add_control(
			'the_title',
			[
				'label' => __( 'Title Text', 'unar' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Unar Head Title',
				'title' => __( 'Enter some text', 'unar' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .head-title .the-title',
			]
		);

		$this->add_control(
			'head_use_subtitle',
			[
				'label' => __( 'Use Subtitle', 'unar' ),
				'type' => Controls_Manager::CHECKBOX,
				'default' => 'on',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'the_subtitle',
			[
				'label' => __( 'Subtitle Text', 'unar' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Unar Subtitle',
				'title' => __( 'Enter some text', 'unar' ),
				'condition' => [
					'head_use_subtitle' => 'on',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_subtitle',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'label' => __( 'Subtitle Text', 'unar' ),
				'selector' => '{{WRAPPER}} .head-title .subtitle',
				'condition' => [
					'head_use_subtitle' => 'on',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'unar' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'unar' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'unar' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'unar' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'unar' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .thetitle' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		/*----- Style 1 Settings -----*/
		$this->start_controls_section(
			'section_unar_head_title_style_1',
			[
				'label' => __( 'Style 1 Settings', 'unar' ),
			]
		);

		$this->add_control(
			'title_color_1',
			[
				'label' => __( 'Title Color', 'unar' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thetitle .title' => 'color: {{VALUE}};',
				],
				'default' => '#2f2f2f',
			]
		);

		$this->add_control(
			'subtitle_color_1',
			[
				'label' => __( 'Subtitle Color', 'unar' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thetitle .text' => 'color: {{VALUE}};',
				],
				'default' => '#7f7f7f',
				'condition' => [
					'head_use_subtitle' => 'on',
				],
			]
		);

		$this->add_control(
			'border_style_1',
			[
				'label' => __( 'Separator Color', 'unar' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thetitle .bord' => 'background-color: {{VALUE}};',
				],
				'default' => '#2f2f2f',
			]
		);

		$this->end_controls_section();
		/*----- Style 1 Settings end -----*/
	}

	protected function render() {

		$instance = $this->get_settings();

		/* General Controls */
		$the_title 			= ! empty( $instance['the_title'] ) ? $instance['the_title'] : 'Unar Head Title';
		$head_use_subtitle	=  $instance['head_use_subtitle'];
		$title_size 		= ! empty( $instance['title_size'] ) ? $instance['title_size'] : 'h2';
		$the_subtitle 		= ! empty( $instance['the_subtitle'] ) ? $instance['the_subtitle'] : 'Unar Subtitle';
		

		/* Choose Style */
		include ( plugin_dir_path(__FILE__).'tpl/title-block.php' );

		?>

		<?php

	}

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {

	}
}

Plugin::instance()->widgets_manager->register_widget_type( new unar_head_title() );