<?php
/*
Plugin Name: Rename Author Slug
Description: This simple plugin changes the author based permalink slug 'author' to anything you wish.
Author: BluBird Interactive
Plugin URI: https://wordpress.org/plugins/rename-author-slug/
Author URI: http://blubirdinteractive.com
Version: 1.1.0
License: GPL2+
Text Domain: BluBird
*/
function author_base_url(){
	add_menu_page( 'Author Slug', 'Author Slug', 'administrator', 'author_base', 'author_base_page', plugin_dir_url( __FILE__ ).'/images/icon.png', 10 );
}
add_action('admin_menu', 'author_base_url');
function author_base_page(){
	echo '<div class="wrap">';
	echo "<h2>" . __( 'Author Slug', 'author-url' ) . "</h2>";
?>
<?php if($_POST){
	$user_input = $_POST['author_url'];
	update_option('author_permalink', $user_input)
	?>
<div class="updated below-h2" id="message">
	<p>Author Slug Changed.</p>
</div>
	<?php
}?>
	<form action="" method="post">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="author_url">Type New Author Slug:</label></th>
					<td><input type="text" name="author_url" id="author_url" value="<?php echo get_option('author_permalink'); ?>" placeholder="Example: blogger" size="20" /></td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" value="Save Changes" class="button button-primary" id="submit" name="submit">
		</p>
</form>
</div>
<?php
}
	function change_author_permalinks() {
		global $wp_rewrite;
		$wp_rewrite->author_base = get_option('author_permalink');
		$wp_rewrite->flush_rules();
	}
	if(get_option('author_permalink') != ''){
	add_action('init','change_author_permalinks');
	}
	else{
		delete_option('author_permalink');
		delete_option('rewrite_rules');
	}
