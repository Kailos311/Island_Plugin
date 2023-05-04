<?php
add_action('init', 'Bo01StartSession', 1);
function Bo01StartSession() {
    if(!session_id()) {
        session_start();
    }
}
add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_style( 'bowsp-style', BOWSP_URI.'/assets/css/style.css', array(), '1.0.0.5', 'all');  
});

function bowsp_custom_admin_menu()
{
    add_menu_page(__('Point Settings', 'bowsp'), __('Point Settings', 'bowsp'), 'activate_plugins', 'point-settings', 'bowsp_point_settings');  
}

add_action('admin_menu', 'bowsp_custom_admin_menu');

function bowsp_register_custom_settings(){
	 
	
	register_setting( 'bowsp-points-settings', 'bowsp_line_client_id' );
	register_setting( 'bowsp-points-settings', 'bowsp_line_client_secret' );
	register_setting( 'bowsp-points-settings', 'bowsp_line_callback_url' ); 
	register_setting( 'bowsp-points-settings', 'bowsp_login_redirect_url' ); 
    register_setting( 'bowsp-points-settings', 'bowsp_login_url' ); 
	register_setting( 'bowsp-points-settings', 'bowsp_translate_texts' ); 
}
add_action( 'admin_init', 'bowsp_register_custom_settings' );

function bowsp_point_settings(){
?>
	 
	<div class="wrap">
		<h2><?php _e('Points Setting', 'bowsp')?></h2>
		<form method="post" action="options.php">
			<?php settings_fields( 'bowsp-points-settings' ); ?>
			<?php do_settings_sections( 'bowsp-points-settings' ); ?>
			 
			<table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
				<tr class="form-field">
					<th valign="top" scope="row">
						<label for="name"><?php _e('LINE Client ID', 'bowsp')?></label>
					</th>
					<td>
					<?php 
					$line_client_id = get_option('bowsp_line_client_id') ;
					?>
					<input type="text" name="bowsp_line_client_id" value="<?php echo  $line_client_id; ?>"  required/>
					</td>
				</tr>
				<tr class="form-field">
					<th valign="top" scope="row">
						<label for="name"><?php _e('LINE Client Secret', 'bowsp')?></label>
					</th>
					<td>
					<?php 
					$line_client_secret = get_option('bowsp_line_client_secret') ;
					?>
					<input type="text" name="bowsp_line_client_secret" value="<?php echo $line_client_secret; ?>" required />
					</td>
				</tr>
				<tr class="form-field">
					<th valign="top" scope="row">
						<label for="name"><?php _e('LINE Callback URL', 'bowsp')?></label>
					</th>
					<td>
					<?php 
					$line_callback_url = get_option('bowsp_line_callback_url') ;
					?>
					<input type="url" name="bowsp_line_callback_url" value="<?php echo $line_callback_url; ?>" required />
					</td>
				</tr>
				<tr class="form-field">
					<th valign="top" scope="row">
						<label for="name"><?php _e('Redirect after login URL', 'bowsp')?></label>
					</th>
					<td>
					<?php 
					$login_redirect_url = get_option('bowsp_login_redirect_url') ;
					?>
					<input type="url" name="bowsp_login_redirect_url" value="<?php echo $login_redirect_url; ?>" required />
					</td>
				</tr>
				<tr class="form-field">
					<th valign="top" scope="row">
						<label for="name"><?php _e('Login URL', 'bowsp')?></label>
					</th>
					<td>
					<?php 
					$login_redirect_url = get_option('bowsp_login_url') ;
					?>
					<input type="url" name="bowsp_login_url" value="<?php echo $login_redirect_url; ?>" required />
					</td>
				</tr>
				
			</table>
			<hr />
			<h3><?php _e('Translate', 'bowsp')?></h3>
			<table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
				<tr class="form-field">
					<th valign="top" scope="row">
						<label for="name"><?php _e('You need to login first!', 'bowsp')?></label>
					</th>
					<td>
					<?php 
					$texts = get_option('bowsp_translate_texts') ;
					?>
					<input type="text" name="bowsp_translate_texts[need_login_first]" value="<?php echo  isset( $texts['need_login_first']) ? $texts['need_login_first'] : ''; ?>" placeholder="<?php _e('You need to login first!', 'bowsp')?>"  required/>
					</td>
				</tr>
				<tr class="form-field">
					<th valign="top" scope="row">
						<label for="name"><?php _e('Click here', 'bowsp')?></label>
					</th>
					<td>
					<?php 
					$texts = get_option('bowsp_translate_texts') ;
					?>
					<input type="text" name="bowsp_translate_texts[click_here]" value="<?php echo  isset( $texts['click_here']) ? $texts['click_here'] : ''; ?>" placeholder="<?php _e('Click here', 'bowsp')?>"  required/>
					</td>
				</tr>
				<tr class="form-field">
					<th valign="top" scope="row">
						<label for="name"><?php _e('Congratulations, you have interacted with the islanders', 'bowsp'); ?></label>
					</th>
					<td>
					 
					<input type="text" name="bowsp_translate_texts[congratulations]" value="<?php echo  isset( $texts['congratulations']) ? $texts['congratulations'] : ''; ?>" placeholder="<?php _e('Congratulations, you have interacted with the islanders', 'bowsp'); ?>"  required/>
					</td>
				</tr>
				<tr class="form-field">
					<th valign="top" scope="row">
						<label for="name"><?php _e('Get points', 'bowsp'); ?></label>
					</th>
					<td>
					 
					<input type="text" name="bowsp_translate_texts[get_points]" value="<?php echo  isset( $texts['get_points']) ? $texts['get_points'] : ''; ?>" placeholder="<?php _e('Get points', 'bowsp'); ?>"  required/>
					</td>
				</tr>
				<tr class="form-field">
					<th valign="top" scope="row">
						<label for="name"><?php _e('Points:', 'bowsp'); ?></label>
					</th>
					<td>
					 
					<input type="text" name="bowsp_translate_texts[points]" value="<?php echo  isset( $texts['points']) ? $texts['points'] : ''; ?>" placeholder="<?php _e('Points', 'bowsp'); ?>"  required/>
					</td>
				</tr>
				<tr class="form-field">
					<th valign="top" scope="row">
						<label for="name"><?php _e('You are already get points, you only can get other points after 24 hours!', 'bowsp'); ?></label>
					</th>
					<td> 
						<input type="text" name="bowsp_translate_texts[already_get_points]" value="<?php echo  isset( $texts['already_get_points']) ? $texts['already_get_points'] : ''; ?>" placeholder="<?php _e('You are already get points, you only can get other points after 24 hours!', 'bowsp'); ?>"  required/>
					</td>
				</tr>
				
				
			</table>
 
			<?php submit_button(); 
		
		
			?>
			 
		</form>
	</div>
<?php
}



 
add_shortcode( 'line-login', function($attr){
	$callback_url = get_option('bowsp_line_callback_url');
	 
	ob_start();
	if(is_user_logged_in()){
		$user = wp_get_current_user();
		echo 'Your Name: '.$user->display_name;
		echo '<br /><a href="'.wp_logout_url( home_url() ).'">Logout</a>';
	}
	else{	 
		$state=rand(); 
		$link = 'https://access.line.me/oauth2/v2.1/authorize?response_type=code&client_id='.get_option('bowsp_line_client_id') .'&state='.$state.'&scope=profile&redirect_uri='.urlencode($callback_url);
		echo '<a href="'.$link.'" class="button line-login-btn">Login</a>'; 
	}
	return ob_get_clean(); 
});


function line_callback_process(){
	if(isset($_GET["action"]) && $_GET["action"] == 'line_login_callback' && isset($_GET["code"])){
		 
		
		$url = "https://api.line.me/oauth2/v2.1/token";
		$redirect_uri = urlencode(get_option('bowsp_line_callback_url'));//get_permalink(get_the_ID());
		$postData = array(
			"grant_type" => "authorization_code",
			"code" => $_GET["code"],
			"redirect_uri" => get_option('bowsp_line_callback_url'),
			"client_id" => get_option('bowsp_line_client_id') ,
			"client_secret" => get_option('bowsp_line_client_secret'), 
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($ch, CURLOPT_URL, 'https://api.line.me/oauth2/v2.1/token');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		
		$json = json_decode($response);
		//print_r($json);  
		if(isset($json->access_token)){
		
			$accessToken = $json->access_token;
			  
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $accessToken));
			curl_setopt($ch, CURLOPT_URL, 'https://api.line.me/v2/profile');
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
			curl_close($ch);

			$user_info = json_decode($response);
			$userId = $user_info->userId;
			$name = $user_info->displayName;
			$pictureUrl = $user_info->pictureUrl;
			$_SESSION['pictureUrl'] = $pictureUrl;
			//print_r($user_info);
			$logged = false;
			if(!username_exists( $userId )){
				
				$userdata = array( 
					'user_login' =>  $userId,
					'user_pass'  =>  '123456',
					'display_name' => $name
				);  
				$user_id = wp_insert_user( $userdata ) ;
				if ( ! is_wp_error( $user_id ) ) { 
					wp_set_current_user($user_id);
					wp_set_auth_cookie($user_id); 
					update_user_meta($user_id, 'avatar', $pictureUrl);
					$logged = true;
				} 
				else{
					echo 'Can not login';
				}
			}
			else{ 
				$user = get_user_by('login', $userId);
				if($user){
					wp_set_current_user($user->ID);
					wp_set_auth_cookie($user->ID); 
					update_user_meta($user->ID, 'avatar', $pictureUrl);
					$logged = true;
				}
				else{
					echo 'Can not login';
				} 
			}
			if($logged){
				wp_redirect(get_option('bowsp_login_redirect_url'));
				exit;
			}
		}

	}
}
add_action('init', 'line_callback_process', 1);
 /*
add_shortcode( 'my-profile', function(){
	  
	ob_start();
	?>
	<div class="bowsp">
		<div class="profile-screen">
			
		<?php
			
		if(is_user_logged_in()){
		?>
			
			<?php
			$user = wp_get_current_user();
			$avatar = get_user_meta($user->ID, 'avatar', true);
			?>
			<div class="head-info">
			<?php 
			if($avatar != ''){
				echo '	<div class="bo-avatar"><img src="'.$avatar.'" /></div>';
			}
			echo '		<span class="info-name">'.$user->display_name.'</span>';
			?>
			</div>
			<div class="current-points box-point">
				<label>Current Points<label>
				<div class="current-points-value"><?php echo get_user_meta($user->ID, 'points', true) != '' ? get_user_meta($user->ID, 'points', true) : '0'; ?></div>
			</div>
			<?php
		 
 
			echo '<p><a href="'.wp_logout_url( home_url() ).'">Logout</a></p>';
		?>
			 
		<?php
		}
		else{
			echo 'You are not logged in, please <a href="https://demo.bosoftvn.com/wordpress/login-line/">login here</a>';
		}
		?>
		</div>
	</div>
	<?php
	 
	return ob_get_clean();
	 
});
*/

add_shortcode( 'get-point-btn', 'get_point_btn_shortcode' );
function get_point_btn_shortcode( $atts ) {
	global $post;
	 
	$point_id = $atts['id'];
	$points = get_post_meta( $point_id, 'points', true );
	$page_url = get_permalink($post->ID);
	$get_point_url = add_query_arg( array(
		'action' => 'get-points',
		'point_id' => $point_id,
	), $page_url );
	$texts = get_option('bowsp_translate_texts') ;
	ob_start();
	?>
	<div class="bowsp">
		<div class="get-points-screen">
		<?php
		if(!is_user_logged_in()){
			echo $texts['need_login_first'].' <a href="'.get_option('bowsp_login_url').'">'.$texts['click_here'].'</a>'; 
		}
		else{
			$user_id = get_current_user_id();
			$scanned_points = get_user_meta($user_id, 'scanned_points', true);
			 
			$scanned = false;
			if(is_array($scanned_points) && count($scanned_points)){
				 
					if(isset($scanned_points[$point_id])){
						$scanned_time = $scanned_points[$point_id];
						$hours = abs(current_time( 'timestamp' ) - $scanned_time)/3600;
						if($hours < 24){
							$scanned = true;
						}
					}
				 
			}
			if(!$scanned){
		?>
			<p class=""><?php echo $texts['congratulations']; ?></p>
			<div class="point-value"><label><?php echo $texts['points']; ?></label><span><?php echo $points; ?></span></div>
			<a href="<?php echo $get_point_url; ?>" class="bo-btn"><?php echo $texts['get_points']; ?></a>
		<?php
			}
			else{
				echo $texts['already_get_points'];
			}
		}
		?>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_action('init', 'convert_point_to_currency');
 
function convert_point_to_currency(){
	if(isset($_GET["action"]) && $_GET["action"] == 'convert-points' ){
		$user_id = get_current_user_id();
		$points = (int) get_user_meta( $user_id, 'points', true );
		$level = get_user_meta($user_id, 'level', true) == '' ? 0 : (int) get_user_meta($user_id, 'level', true);
		
		$current_currency = get_user_meta($user_id, 'currency', true) == '' ? 0 : (int) get_user_meta($user_id, 'currency', true);
		$converted_time = (int) get_user_meta($user_id, 'currency_converted_time', true);

		$hours = abs( (int) current_time( 'timestamp' ) - $converted_time)/3600;
	
		if($hours > 24){ 
			if($points >= 100){
				$exchanged_currency = round( ($level * $points) / 100 );
				$points = $points - $exchanged_currency;
				update_user_meta($user_id, 'points', $points);
		 
				$current_currency += $exchanged_currency;
				update_user_meta($user_id, 'currency', $current_currency);
				
				
				update_user_meta($user_id, 'currency_converted_time', current_time( 'timestamp' ));  
			} 
		}
	}

}
function get_points_process(){
	if(isset($_GET["action"]) && $_GET["action"] == 'get-points' && isset($_GET["point_id"]) && is_numeric($_GET["point_id"])){
		$user_id = get_current_user_id();
		$point_id = $_GET["point_id"];
		$scanned_points = get_user_meta($user_id, 'scanned_points');
		$scanned = false;
		if(isset($scanned_points[$point_id])){
			$scanned_time = $scanned_points[$point_id];
			$hours = abs(current_time( 'timestamp' ) - $scanned_time)/3600;
			if($hours < 24){
				$scanned = true;
			}
		}

		if(!$scanned){
			$points_upgrade = get_user_meta($user_id, 'points_upgrade', true) == '' ? 0 : (int) get_user_meta($user_id, 'points_upgrade', true);
			$current_point = get_user_meta($user_id, 'points', true) == '' ? 0 : get_user_meta($user_id, 'points', true);
			$level = get_user_meta($user_id, 'level', true) == '' ? 0 : (int) get_user_meta($user_id, 'level', true);
			$points = get_post_meta( $point_id, 'points', true );

			$new_points = $points + $points_upgrade;

			$points += $current_point;
			update_user_meta($user_id, 'points', $points);
			  
			if( $new_points >= POINTS_UPDATE_LEVEL){
				$up_level = floor($new_points / POINTS_UPDATE_LEVEL); 
				$level += $up_level; 
				$level = $level > 100 ? 100 : $level;
				update_user_meta($user_id, 'level', $level);

				$points_upgrade = $new_points - ($up_level * POINTS_UPDATE_LEVEL);
				update_user_meta($user_id, 'points_upgrade', $points_upgrade); 
				
			} 
			else{
				//$points_upgrade += $points;
				$points_upgrade = $new_points;
				update_user_meta($user_id, 'points_upgrade', $points_upgrade); 
			}

 
			
			if(!array($scanned_points) || !count($scanned_points)){
				$scanned_points = array();
			}
		
			$scanned_points[$point_id] =  current_time( 'timestamp' );
			
			update_user_meta($user_id, 'scanned_points', $scanned_points);
		} 

		foreach($scanned_points as $_point_id => $time){
			$hours = abs(current_time( 'timestamp' ) - (int) $time)/3600;
			if($hours > 24){
				unset($scanned_points[$_point_id]);
			}
		}
		 
		wp_redirect('https://demo.bosoftvn.com/wordpress/my-profile/');
		exit;
	} 
}
add_action('init', 'get_points_process', 1); 


if ( ! function_exists('register_point_post_type') ) {

	// Register Custom Post Type
	function register_point_post_type() {
	
		$labels = array(
			'name'                  => _x( 'Points', 'Post Type General Name', 'bowsp' ),
			'singular_name'         => _x( 'Point', 'Post Type Singular Name', 'bowsp' ),
			'menu_name'             => __( 'Points', 'bowsp' ),
			'name_admin_bar'        => __( 'Points', 'bowsp' ),
			'archives'              => __( 'Item Archives', 'bowsp' ),
			'attributes'            => __( 'Item Attributes', 'bowsp' ),
			'parent_item_colon'     => __( 'Parent Point:', 'bowsp' ),
			'all_items'             => __( 'All Points', 'bowsp' ),
			'add_new_item'          => __( 'Add New Point', 'bowsp' ),
			'add_new'               => __( 'Add New', 'bowsp' ),
			'new_item'              => __( 'New Point', 'bowsp' ),
			'edit_item'             => __( 'Edit Point', 'bowsp' ),
			'update_item'           => __( 'Update Point', 'bowsp' ),
			'view_item'             => __( 'View Point', 'bowsp' ),
			'view_items'            => __( 'View Points', 'bowsp' ),
			'search_items'          => __( 'Search Point', 'bowsp' ),
			'not_found'             => __( 'Not found', 'bowsp' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'bowsp' ),
			'featured_image'        => __( 'Featured Image', 'bowsp' ),
			'set_featured_image'    => __( 'Set featured image', 'bowsp' ),
			'remove_featured_image' => __( 'Remove featured image', 'bowsp' ),
			'use_featured_image'    => __( 'Use as featured image', 'bowsp' ),
			'insert_into_item'      => __( 'Insert into item', 'bowsp' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'bowsp' ),
			'items_list'            => __( 'Items list', 'bowsp' ),
			'items_list_navigation' => __( 'Items list navigation', 'bowsp' ),
			'filter_items_list'     => __( 'Filter items list', 'bowsp' ),
		);
		$args = array(
			'label'                 => __( 'Point', 'bowsp' ),
			'labels'                => $labels,
			'supports'              => array( 'title' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'bo-point', $args );
	
	}
	add_action( 'init', 'register_point_post_type', 0 );
	
}

	//Register Meta box
add_action( 'add_meta_boxes', function() {
	add_meta_box( 'wpdocs-id', 'Info', 'bo_point_fields_cb', 'bo-point', 'normal', 'high' );
} );

//Meta callback function
function bo_point_fields_cb( $post ) {
	$points = get_post_meta( $post->ID, 'points', true );
	?>
	<label>Points:</label>
	<input type="number" name="points" value="<?php echo esc_attr( $points ) ?>" style="width: 100%" required>
	<?php
}

//save meta value with save post hook
add_action( 'save_post', function( $post_id ) {
	if ( isset( $_POST['points'] ) ) {
		update_post_meta( $post_id, 'points', $_POST['points'] );
	}
} );


// Register the columns.
add_filter( "manage_bo-point_posts_columns", function ( $columns ) {
	 
	$columns = array(
		'cb' => $columns['cb'], 
		'title' => __( 'Title' ),
		'point' => __( 'Points', 'bowsp' ),
		'shortcode' => __( 'Shortcode', 'bowsp' ),
		'date' => __( 'Date' ),
	  );

	return $columns;
} );

// Handle the value for each of the new columns.
add_action( "manage_bo-point_posts_custom_column", function ( $column_name, $post_id ) {
	
	if ( $column_name == 'point' ) {
		echo get_post_meta( $post_id, 'points', true );
	}
	
	if ( $column_name == 'shortcode' ) {
		// Display an ACF field
		echo '[get-point-btn id="'.$post_id.'"]';
	}
	
}, 10, 2 );



add_shortcode( 'level', 'user_level_value_shortcode' );
function user_level_value_shortcode( $atts ) { 
	ob_start();
	if(is_user_logged_in()){
		$user_id = get_current_user_id();
		$level = get_user_meta($user_id, 'level', true) == '' ? 0 : get_user_meta($user_id, 'level', true);
		echo '<span class="user-level-value">'.$level.'</span>';
	}
	return ob_get_clean();
}

add_shortcode( 'points', 'user_points_value_shortcode' );
function user_points_value_shortcode( $atts ) { 
	ob_start();
	if(is_user_logged_in()){
		$user_id = get_current_user_id();
		$points = get_user_meta($user_id, 'points', true) != '' ? get_user_meta($user_id, 'points', true) : 0; 
		echo '<span class="user-points-value">'.$points.'</span>';
	}
	return ob_get_clean();
}

add_shortcode( 'currency', 'user_currency_value_shortcode' );
function user_currency_value_shortcode( $atts ) { 
	ob_start();
	if(is_user_logged_in()){
		$user_id = get_current_user_id();
		$currency = get_user_meta($user_id, 'currency', true) != '' ? get_user_meta($user_id, 'currency', true) : 0; 
		echo '<span class="user-currency-value">'.$currency.'</span>';
	}
	return ob_get_clean();
}

add_shortcode( 'user-avatar', 'user_avatar_shortcode' );
function user_avatar_shortcode( $atts ) { 
	ob_start();  
	if(is_user_logged_in()){
		$user = wp_get_current_user(); 
		$avatar = get_user_meta($user->ID, 'avatar', true); 
		if($avatar != ''){
			echo '	<div class="bo-avatar"><img src="'.$avatar.'" /></div>';
		} 
	}
	return ob_get_clean();
}

add_shortcode( 'name', 'user_name_shortcode' );
function user_name_shortcode( $atts ) { 
	ob_start();
 
	if(is_user_logged_in()){ 
		$user = wp_get_current_user();
		$avatar = get_user_meta($user->ID, 'avatar', true); 
		echo '<span class="info-name">'.$user->display_name.'</span>'; 
	}
	return ob_get_clean();
}

add_shortcode( 'convert-points-url', 'convert_points_to_currency_url_shortcode' );
function convert_points_to_currency_url_shortcode( $atts ) { 
	global $post; 
	$current_page_url = get_the_permalink($post->ID); 
	return '<a class="convert-points" href="'.add_query_arg( 'action', 'convert-points', $current_page_url ).'">Convert</a>';
}


add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
    <h3><?php _e("Points / Level", "blank"); ?></h3>

    <table class="form-table">
    <tr>
        <th><label for="address"><?php _e("Points"); ?></label></th>
        <td>
            <input type="text" name="points" id="points" value="<?php echo esc_attr( get_user_meta( $user->ID, 'points', true ) ); ?>" class="regular-text" /><br />
        </td>
    </tr>
    <tr>
        <th><label for="level"><?php _e("Level"); ?></label></th>
        <td>
            <input type="text" name="level" id="level" value="<?php echo esc_attr( get_user_meta( $user->ID , 'level', true ) ); ?>" class="regular-text" /><br /> 
        </td>
    </tr>
     
    </table>
<?php }

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    if ( empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'update-user_' . $user_id ) ) {
        return;
    }
    
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    } 
    update_user_meta( $user_id, 'points', $_POST['points'] );
    update_user_meta( $user_id, 'level', $_POST['level'] );  
}