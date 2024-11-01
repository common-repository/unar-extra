<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class unar_portfolio_block extends Widget_Base {

	public function get_name() {
		return 'unar-portfolio-block';
	}

	public function get_title() {
		return __( 'Unar Portolio Block', 'unar' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'unar-category' ];
	}

	protected function _register_controls() {


		/*===========GENERAL CONTROL=============*/

		$this->start_controls_section(
			'section_unar_portfolio_block',
			[
				'label' => __( 'Portfolio Setting', 'unar' ),
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Post per Block', 'unar' ),
				'type' => Controls_Manager::TEXT,
				'default' => '6',
				'title' => __( 'Enter some text', 'unar' ),
				'description' => __( 'This option allow you to set how much post display in this block.', 'unar' ),	
			]
		);

		$this->add_control(
			'offset',
			[
				'label' => __( 'Offset', 'unar' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __( 'Enter some text', 'unar' ),
				'description' => __( 'Set the first post to display (start from 0 as the latest post in each order).', 'unar' ),
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => __( 'Order By', 'unar' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => unar_order_by(),
				'description' => __( 'Select post order by (default to latest post).', 'unar' ),
			]
		);

		$this->add_control(
			'choose_column',
			[
				'label' => __( 'Column', 'unar' ),
				'type' => Controls_Manager::SELECT,
				'default' => 3,
				'options' => [
					'12' => __( '1', 'unar' ),
					'6' => __( '2', 'unar' ),
					'4' => __( '3', 'unar' ),
					'3' => __( '4', 'unar' ),
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$instance = $this->get_settings();

		$offset 			= ! empty( $instance['offset'] ) ? (int)$instance['offset'] : '';
		$post_per_page 		= ! empty( $instance['posts_per_page'] ) ? (int)$instance['posts_per_page'] : 6;
		$orderby			= ! empty( $instance['orderby'] ) ? $instance['orderby'] : 'date';
		$choose_column 		= ! empty( $instance['choose_column'] ) ? $instance['choose_column'] : 3;

		include ( plugin_dir_path(__FILE__).'tpl/portfolio-block.php' );

		?>

		<?php

	}

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new unar_portfolio_block() );