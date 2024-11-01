<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'unar_extra_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category Unar
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( UNAR_EXTRA_PATH.'inc/cmb2/init.php' ) ) {
	require_once UNAR_EXTRA_PATH.'inc/cmb2/init.php';
} elseif ( file_exists( UNAR_EXTRA_PATH.'inc/CMB2/init.php' ) ) {
	require_once UNAR_EXTRA_PATH.'inc/CMB2/init.php';
}

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object.
 *
 * @return bool             True if metabox should show
 */
function unar_extra_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template.
	if ( get_option( 'page_on_front' ) !== $cmb->object_id ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object.
 *
 * @return bool                     True if metabox should show
 */
function unar_extra_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category.
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Manually render a field.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function unar_extra_render_row_cb( $field_args, $field ) {
	$classes     = $field->row_classes();
	$id          = $field->args( 'id' );
	$label       = $field->args( 'name' );
	$name        = $field->args( '_name' );
	$value       = $field->escaped_value();
	$description = $field->args( 'description' );
	?>
	<div class="custom-field-row <?php echo esc_attr( $classes ); ?>">
		<p><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label></p>
		<p><input id="<?php echo esc_attr( $id ); ?>" type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo $value; ?>"/></p>
		<p class="description"><?php echo esc_html( $description ); ?></p>
	</div>
	<?php
}

/**
 * Manually render a field column display.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function unar_extra_display_text_small_column( $field_args, $field ) {
	?>
	<div class="custom-column-display <?php echo esc_attr( $field->row_classes() ); ?>">
		<p><?php echo $field->escaped_value(); ?></p>
		<p class="description"><?php echo esc_html( $field->args( 'description' ) ); ?></p>
	</div>
	<?php
}

/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */

add_action( 'cmb2_admin_init', 'unar_extra_register_pages_metabox' );

function unar_extra_register_pages_metabox() {
	$prefix = 'unar_extra_';
	$unar_extra_pages = new_cmb2_box( array(
		'id'            => $prefix . 'page_options',
		'title'         => esc_html__( 'Pages Metabox', 'unar_extra' ),
		'object_types'  => array( 'page', ), // Post type
		// 'show_on_cb' => 'unar_extra_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
		// 'classes_cb' => 'unar_extra_add_some_classes', // Add classes through a callback.
	) );
	$unar_extra_pages->add_field( array(
		'name' => esc_html__( 'Show/Hide Title', 'unar_extra' ),
		'desc' => esc_html__( 'Check the box to show title.', 'unar_extra' ),
		'id'   => 'show_hide_title',
		'type' => 'radio_inline',
		'options' => array(
	        'show' => __( 'Show Title', 'unar_extra' ),
	        'hide'   => __( 'Hide Title', 'unar_extra' ),
	    ),
	    'default' => 'show',
	) );

	$unar_extra_porto = new_cmb2_box( array(
		'id'            => $prefix . 'portofolio_options',
		'title'         => esc_html__( 'Portfolio Metabox', 'unar_extra' ),
		'object_types'  => array( 'unar-portfolio', ), // Post type
	) );
	$unar_extra_porto->add_field( array(
		'name' => esc_html__( 'Hero Image', 'unar_extra' ),
		'desc' => esc_html__( 'Upload an image or enter a URL.', 'unar_extra' ),
		'id'   => 'portfolio_hero_image',
		'type' => 'file',
	) );
	$unar_extra_porto->add_field( array(
		'name'       => esc_html__( 'Portfolio Author', 'unar_extra' ),
		'desc'       => esc_html__( 'Add Author here', 'unar_extra' ),
		'id'         => 'portfolio_author',
		'type'       => 'text',
	) );
	$unar_extra_porto->add_field( array(
		'name'       => esc_html__( 'Portfolio Date', 'unar_extra' ),
		'desc'       => esc_html__( 'Insert Date here', 'unar_extra' ),
		'id'         => 'portfolio_date',
		'type'       => 'text',
	) );
	$unar_extra_porto->add_field( array(
		'name'       => esc_html__( 'Portfolio Client', 'unar_extra' ),
		'desc'       => esc_html__( 'Add your Client name here', 'unar_extra' ),
		'id'         => 'portfolio_client',
		'type'       => 'text',
	) );
	$unar_extra_porto->add_field( array(
		'name'       => esc_html__( 'Portfolio Website', 'unar_extra' ),
		'desc'       => esc_html__( 'Insert you Project Url here', 'unar_extra' ),
		'id'         => 'portfolio_website',
		'type'       => 'text_url',
	) );

}

/**
 * Only show this box in the CMB2 REST API if the user is logged in.
 *
 * @param  bool                 $is_allowed     Whether this box and its fields are allowed to be viewed.
 * @param  CMB2_REST_Controller $cmb_controller The controller object.
 *                                              CMB2 object available via `$cmb_controller->rest_box->cmb`.
 *
 * @return bool                 Whether this box and its fields are allowed to be viewed.
 */
function unar_extra_limit_rest_view_to_logged_in_users( $is_allowed, $cmb_controller ) {
	if ( ! is_user_logged_in() ) {
		$is_allowed = false;
	}

	return $is_allowed;
}