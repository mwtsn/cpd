<?php
/**
 * Template to render Privacy Widget
 */
$current_user                   = wp_get_current_user();
$roles                          = $current_user->roles;
$is_supervisor                  = CPD_Users::user_is_site_supervisor( $current_user );
$has_templates 					= CPD_Blogs::user_has_templates( $current_user );
$blogs                          = get_blogs_of_user( $current_user->ID );
?>
<div>
	<div class="content-description">
		<p>Templates define the content and settings that are added to a new Journal when it is created.</p>
		<?php 

			if( $has_templates ) {
				?>
				<p>You can edit the following Templates:</p>

				<ul class="tax-list">
					<?php 
					foreach( $blogs as $blog ) {
						if( strrpos( $blog->path, '/template-' ) === 0 ) {
						?>
							<li>
								<span class="dashicons-before dashicons-welcome-write-blog"></span>
								<a href="<?php echo $blog->siteurl . '/wp-admin/';?>"><?php echo $blog->blogname;?></a>
							</li>
						<?php
						}
					}
					?>
				</ul>
				<?php
			} else {
				?>
				<p>You do not currently have access to any Templates.</p>
				<?php
			}
		?>
	</div>
	
</div>