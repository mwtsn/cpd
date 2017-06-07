<?php

namespace mkdo\aspire;

/**
 * Class Options
 *
 * Options page for the plugin
 *
 * @package mkdo\aspire
 */
class Options {

	/**
	 * Constructor
	 */
	public function __construct() {
	}

	/**
	 * Do Work
	 */
	public function run() {
		add_action( 'admin_init', array( $this, 'init_options_page' ) );
		add_action( 'network_admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'plugin_action_links_' . plugin_basename( MKDO_ASPIRE_ROOT ) , array( $this, 'add_setings_link' ) );
	}

	/**
	 * Initialise the Options Page
	 */
	public function init_options_page() {

		// Register Settings
		register_setting( 'mkdo_aspire_settings_group', 'mkdo_aspire_visible_taxonomies' );

		// Add sections
		add_settings_section( 'mkdo_aspire_visible_taxonomies_section', 'Visible Taxonomies', array( $this, 'mkdo_aspire_visible_taxonomies_section_cb' ), 'mkdo_aspire_settings' );

    	// Add fields to a section
		add_settings_field( 'mkdo_aspire_visible_taxonomies_section_select', 'Taxonomies:', array( $this, 'mkdo_aspire_visible_taxonomies_section_select_cb' ), 'mkdo_aspire_settings', 'mkdo_aspire_visible_taxonomies_section' );
	}

	/**
	 * Call back
	 */
	public function mkdo_aspire_visible_taxonomies_section_cb() {
		echo '<p>';
		esc_html_e( 'In this section you can configure how taxonomies are rendered within the system.', MKDO_ASPIRE_TEXT_DOMAIN  );
		echo '</p>';
		echo '<p>';
		esc_html_e( 'Note that setting \'Participants can add new\' to false when the taxonomy uses tags will not stop particpants from adding new tags, it will however stop them from being able to view the admin page for that taxonomy.', MKDO_ASPIRE_TEXT_DOMAIN  );
		echo '</p>';
	}


	/**
	 * Call back
	 */
	public function mkdo_aspire_visible_taxonomies_section_select_cb() {

		$mkdo_aspire_visible_taxonomies = get_option( 'mkdo_aspire_visible_taxonomies', array() );
		update_site_option( 'mkdo_aspire_visible_taxonomies' , $mkdo_aspire_visible_taxonomies );

		$taxonomies = array(
            'development-category' => 'Development Category',
            'competency-category'  => 'Competency Category'
		)

		?>
		<table>
			<tr>
				<td class="empty"></td>
				<th>Show to Supervisors</th>
				<th>Show to Participants</th>
				<th>Participants can add new</th>
				<th>Use tags</th>
			</tr>
			<?php

			foreach( $taxonomies as $key=>$taxonomy ) {
				?>
					<tr>
						<th><?php echo $taxonomy;?></th>
						<td><label><input type="checkbox" name="mkdo_aspire_visible_taxonomies[<?php echo $key;?>][show-to-supervisors]" value='true' <?php checked( $mkdo_aspire_visible_taxonomies[$key]['show-to-supervisors'], 'true', true );?>/><span class="screen-reader-text">Show to Supervisors</span></label></td>
						<td><label><input type="checkbox" name="mkdo_aspire_visible_taxonomies[<?php echo $key;?>][show-to-particpants]" value='true' <?php checked( $mkdo_aspire_visible_taxonomies[$key]['show-to-particpants'], 'true', true );?>/><span class="screen-reader-text">Show to Participants</span></label></td>
						<td><label><input type="checkbox" name="mkdo_aspire_visible_taxonomies[<?php echo $key;?>][particpant-can-add-new]" value='true' <?php checked( $mkdo_aspire_visible_taxonomies[$key]['particpant-can-add-new'], 'true', true );?>/><span class="screen-reader-text">Participants can add new</span></label></td>
						<td><label><input type="checkbox" name="mkdo_aspire_visible_taxonomies[<?php echo $key;?>][use-tags]" value='true' <?php checked( $mkdo_aspire_visible_taxonomies[$key]['use-tags'], 'true', true );?>/><span class="screen-reader-text">Uses tags</span></label></td>
					</tr>
				<?php
			}

			?>
		</table>
		<?php

	}


	/**
	 * Add the options page
	 */
	public function add_options_page() {
		add_submenu_page( 'settings.php', esc_html__( 'Aspire CPD', MKDO_ASPIRE_TEXT_DOMAIN ), esc_html__( 'Aspire CPD', MKDO_ASPIRE_TEXT_DOMAIN ), 'manage_options', 'aspire', array( $this, 'render_options_page' ) );
	}

	/**
	 * Render the options page
	 */
	public function render_options_page() {
		?>
		<div class="wrap">
			<h2><?php esc_html_e( 'Aspire CPD', MKDO_ASPIRE_TEXT_DOMAIN );?></h2>
			<form action="/wp-admin/options.php" method="POST">
	            <?php settings_fields( 'mkdo_aspire_settings_group' ); ?>
	            <?php do_settings_sections( 'mkdo_aspire_settings' ); ?>
	            <?php submit_button(); ?>
	        </form>
		</div>
	<?php
	}

	/**
	 * Add 'Settings' action on installed plugin list
	 */
	function add_setings_link( $links ) {
		array_unshift( $links, '<a href="options-general.php?page=aspire">' . esc_html__( 'Settings', MKDO_ASPIRE_TEXT_DOMAIN ) . '</a>');
		return $links;
	}
}
