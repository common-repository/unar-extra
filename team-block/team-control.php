<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class unar_team_block extends Widget_Base {

	public function get_name() {
		return 'unar-team-block';
	}

	public function get_title() {
		return __( 'Unar Team Block', 'unar' );
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
			'section_unar_team_block',
			[
				'label' => __( 'Team Setting', 'unar' ),
			]
		);

		$this->add_control(
			'team_item',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'text' => __( 'Team Item #1', 'unar' ),
					],
					[
						'text' => __( 'Team Item #2', 'unar' ),
					],
				],
				'fields' => [
					[
						'name' => 'team_name',
						'label' => __( 'Team Author', 'unar' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => __( 'Your team name.', 'unar' ),
					],
					[
						'name' => 'team_job',
						'label' => __( 'Author Job', 'unar' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => __( 'Your team job.', 'unar' ),
					],
					[
						'name' => 'team_img',
						'label' => __( 'Author Image', 'unar' ),
						'type' => Controls_Manager::MEDIA,
						'label_block' => true,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
					[
						'name' => 'team_facebook',
						'label' => __( 'Team Facebook', 'unar' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
					],
					[
						'name' => 'team_twitter',
						'label' => __( 'Team Twitter', 'unar' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
					],
					[
						'name' => 'team_dribbble',
						'label' => __( 'Team Dribbble', 'unar' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
					],
					[
						'name' => 'team_instagram',
						'label' => __( 'Team Instagram', 'unar' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
					],
				],
				'title_field' => '{{{ team_name }}}',
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

		$teams 				= ! empty( $instance['team_item'] ) ? $instance['team_item'] : '';
		$choose_column 		= ! empty( $instance['choose_column'] ) ? $instance['choose_column'] : 3;
		

		include ( plugin_dir_path(__FILE__).'tpl/team-block.php' );



		?>

		<?php

	}

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new unar_team_block() );