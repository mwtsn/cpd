<?php
/**
 * Template to render Comments Dashboard Widget
 */
?>
<?php
	$link                               = get_blog_option( 1, 'cpd_user_guide', 'https://github.com/mkdo/cpd/wiki' );
	$text                               = '<p>You can view guidance on how to use this system by visiting the <a href="'. esc_url( $link ) .'" target="_blank">Wiki</a>.</p>';
	$button_text                        = 'View Wiki';

	$current_user 					    = wp_get_current_user();
	$roles 							    = $current_user->roles;
	$is_elevated_user 				    = get_user_meta( $current_user->ID, 'elevated_user', TRUE ) == '1';

	if( is_network_admin() || $is_elevated_user ) {
		$text                               = '<p>You can view guidance on how to setup and manage this system by viewing the <a href="'. esc_url( $link ) .'" target="_blank">System Administrator User Guide</a>.</p>';
		$button_text                        = 'View User Guide';
	}
	else if( in_array( 'supervisor', $roles ) ) {
		$text                               = '<p>You can view guidance on how to use this system by viewing the <a href="'. esc_url( $link ) .'" target="_blank">Supervisor User Guide</a>.</p>';
		$button_text                        = 'View User Guide';
	}
	else if( in_array( 'participant', $roles ) ) {
		$text                               = '<p>You can view guidance on how to manage your Journal by viewing the <a href="'. esc_url( $link ) .'" target="_blank">Participant User Guide</a>.</p>';
		$button_text                        = 'View User Guide';
	}
?>
<div>

	<div class="content-description">

		<?php echo wp_kses_post( $text );?>

	</div>

	<p class="footer-button"><a class="button" href="<?php echo esc_url( $link );?>"><?php echo $button_text;?></a></p>

</div>
