<?php
	if( !defined('ABSPATH') ) exit;

	if(!is_admin()) {
		die('You need to be admin to access this plugin');
	}

	wp_enqueue_media();

	$wactUpdated = false;
	$wactAnimationStyles =  array( 
		'none' => __('None', 'easy-whatsapp-contact'), 
		'wact-anim-fadein' => __('Fade in', 'easy-whatsapp-contact'), 
		'wact-scale-up-center' => __('Scale', 'easy-whatsapp-contact'), 
		'wact-rotate-in-center' => __('Rotate', 'easy-whatsapp-contact'));

	$wactNumberOfIcons = 21;
	$wactIconSizes = array('50','60','70','80','90','100','110','120','130','140','150','160','170','180','190','200');
	$wactContactText = get_option('wact-contact-text', __('Contact with us', 'easy-whatsapp-contact'));
	$wactPredefinedText = get_option('wact-predefined-text', '');
	$wactContactPhone = get_option('wact-contact-phone', '');
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
	$wactShowDevices = get_option('wact-show-devices', 'all-devices');
	$wactIconStyle = get_option('wact-icon-style', 'icon-style-1');
	$wactIconSize = get_option('wact-icon-size', '70');
	$wactIconAnimation = get_option('wact-icon-animation', 'none');
	$wactIconPosition = get_option('wact-icon-position', 'bottom-right');
	$wactShowDelay = get_option('wact-show-delay', '0');
	$wactIconZindex = get_option('wact-icon-zindex', '999');
	$wactIconMarginSides = get_option('wact-icon-margin-sides', '15');
	$wactIconMarginBottom = get_option('wact-icon-margin-bottom', '15');
	$wactFontSize = get_option('wact-font-size', '15');
	$wactShowChatWindow = get_option('wact-show-chat-window', 'yes');
	$wactWelcomeMessage = get_option('wact-welcome-message', __('Hello! Do you have any question?', 'easy-whatsapp-contact'));
	$wactCustomIcon = get_option('wact-custom-icon', "");
	$wactCustomButton = get_option('wact-custom-button', "");
	$wactButtonSize = get_option('wact-button-size', "50");
	$wactButtonStyle = get_option('wact-button-style', "icon-style-1");

	if($wactIconStyle == "custom" && $wactCustomIcon == "") {
		$wactIconStyle = "icon-style-1";
	}

	if($wactButtonStyle == "custom" && $wactCustomButton == "") {
		$wactButtonStyle = "icon-style-1";
	}

	if(isset($_POST['wact-icon-size'])){
		 if(wp_verify_nonce($_POST['_wpnonce'], 'wact_plugin_form') == false){
		 	echo 'Error saving data';
		 } else {
		 	$wactUpdated = true;

		 	$wactCustomButton = sanitize_text_field($_POST['wact-custom-button']);
		 	update_option('wact-custom-button', $wactCustomButton);

		 	$wactButtonSize = sanitize_text_field($_POST['wact-button-size']);
		 	update_option('wact-button-size', $wactButtonSize);

		 	$wactButtonStyle = sanitize_text_field($_POST['wact-button-style']);
		 	update_option('wact-button-style', $wactButtonStyle);

		 	$wactCustomIcon = sanitize_text_field($_POST['wact-custom-icon']);
		 	update_option('wact-custom-icon', $wactCustomIcon);

		 	$wactContactText = sanitize_text_field($_POST['wact-contact-text']);
		 	update_option('wact-contact-text', $wactContactText);

		 	$wactContactPhone = sanitize_text_field($_POST['wact-contact-phone']);
		 	update_option('wact-contact-phone', preg_replace('/[^0-9]/', '', $wactContactPhone));

		 	$wactShowChatWindow = sanitize_text_field($_POST['wact-show-chat-window']);
		 	update_option('wact-show-chat-window', $wactShowChatWindow);

		 	$wactShowDevices = sanitize_text_field($_POST['wact-show-devices']);
		 	update_option('wact-show-devices', $wactShowDevices);

		 	$wactIconPosition = sanitize_text_field($_POST['wact-icon-position']);
		 	update_option('wact-icon-position', $wactIconPosition);

		 	$wactIconStyle = sanitize_text_field($_POST['wact-icon-style']);
		 	update_option('wact-icon-style', $wactIconStyle);

		 	$wactIconSize = sanitize_text_field($_POST['wact-icon-size']);
		 	update_option('wact-icon-size', $wactIconSize);

		 	$wactShowDelay = sanitize_text_field($_POST['wact-show-delay']);
		 	update_option('wact-show-delay', $wactShowDelay);

		 	$wactPredefinedText = sanitize_text_field($_POST['wact-predefined-text']);
		 	update_option('wact-predefined-text', $wactPredefinedText);

		 	$wactIconAnimation = sanitize_text_field($_POST['wact-icon-animation']);
		 	update_option('wact-icon-animation', $wactIconAnimation);

		 	$wactIconMarginSides = sanitize_text_field($_POST['wact-icon-margin-sides']);
		 	update_option('wact-icon-margin-sides', $wactIconMarginSides);

		 	$wactIconMarginBottom = sanitize_text_field($_POST['wact-icon-margin-bottom']);
		 	update_option('wact-icon-margin-bottom', $wactIconMarginBottom);

		 	$wactIconZindex = sanitize_text_field($_POST['wact-icon-zindex']);
		 	update_option('wact-icon-zindex', $wactIconZindex);

		 	$wactFontSize = sanitize_text_field($_POST['wact-font-size']);
		 	update_option('wact-font-size', $wactFontSize);

		 	$wactShowOptionsFrontPage = sanitize_text_field($_POST['wact-show-options-front-page']);
		 	update_option('wact-show-options-front-page', $wactShowOptionsFrontPage);

		 	$wactShowOptionsBlogPage = sanitize_text_field($_POST['wact-show-options-blog-page']);
		 	update_option('wact-show-options-blog-page', $wactShowOptionsBlogPage);

		 	$wactShowOptions404 = sanitize_text_field($_POST['wact-show-options-404']);
		 	update_option('wact-show-options-404', $wactShowOptions404);

		 	$wactShowOptionsSearch = sanitize_text_field($_POST['wact-show-options-search']);
		 	update_option('wact-show-options-search', $wactShowOptionsSearch);

		 	$wactShowOptionsArchive = sanitize_text_field($_POST['wact-show-options-archive']);
		 	update_option('wact-show-options-archive', $wactShowOptionsArchive);

		 	$wactShowOptionsPage = sanitize_text_field($_POST['wact-show-options-page']);
		 	update_option('wact-show-options-page', $wactShowOptionsPage);

		 	$wactShowOptionsSingle = sanitize_text_field($_POST['wact-show-options-single']);
		 	update_option('wact-show-options-single', $wactShowOptionsSingle);

		 	$wactShowOptionsProduct = sanitize_text_field($_POST['wact-show-options-product']);
		 	update_option('wact-show-options-product', $wactShowOptionsProduct);

		 	$wactShowOptionsCart = sanitize_text_field($_POST['wact-show-options-cart']);
		 	update_option('wact-show-options-cart', $wactShowOptionsCart);

		 	$wactShowOptionsCheckout = sanitize_text_field($_POST['wact-show-options-checkout']);
		 	update_option('wact-show-options-checkout', $wactShowOptionsCheckout);

		 	$wactShowOptionsAccountPage = sanitize_text_field($_POST['wact-show-options-account-page']);
		 	update_option('wact-show-options-account-page', $wactShowOptionsAccountPage);

		 	$wactWelcomeMessage = sanitize_text_field($_POST['wact-welcome-message']);
		 	update_option('wact-welcome-message', $wactWelcomeMessage);

		 	if($wactIconStyle == "custom" && empty($wactCustomIcon )) {
				$wactIconStyle = "icon-style-1";
			}

			if($wactButtonStyle == "custom" && empty($wactCustomButton )) {
				$wactButtonStyle = "icon-style-1";
			}
		 }

	}

?>

<div class="wact-admin wrap">
	<div class="wact-header">
		<h1>
			Easy Contact Chat 😜
		</h1>
	</div>
	
	<form class="wact-form" method="POST">
		<?php wp_nonce_field( 'wact_plugin_form'); ?>
		<div class="wact-alert" style="display:<?php 
		  if($wactUpdated){
				echo 'block';
			} else {
				echo 'none';
			}  
		  ?>">
			<?php echo __('Settings saved successfully', 'easy-whatsapp-contact')?>
		</div>
			<div class="wact-section">
				<h3><?php echo __('General', 'easy-whatsapp-contact')?></h3>
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row"><?php echo __('Your phone number', 'easy-whatsapp-contact')?></th>
							<td>
								<input id='wact-contact-phone' name='wact-contact-phone' type='text' placeholder='' value='<?php echo $wactContactPhone ?>'/> 
								<p class="description"><?php echo __('Your phone number with <strong>international prefix</strong>. Example: +33 6770084144. <a href="https://countrycode.org/" target="_blank">Click here to see the list</a>', 'easy-whatsapp-contact')?></p>
							</td>
						</tr>

						<tr>
							<th scope="row"><?php echo __('Predefined message', 'easy-whatsapp-contact')?></th>
							<td>
								<textarea style="width: 300px" id='wact-predefined-text' name='wact-predefined-text' type='text' placeholder=''><?php echo wp_unslash($wactPredefinedText) ?></textarea>
								<p class="description"><?php echo __('Optional. A predefined text to start the chat. Empty if you do not want to show it.', 'easy-whatsapp-contact')?> </p>
							</td>
						</tr>

					</tbody>
				</table>
				<input type='submit' id='wact-submit' value='<?php echo __('Save settings', 'easy-whatsapp-contact')?>' class="wact-settings-btn">
			</div>

			

			<div class="wact-section">

				<h3><?php echo __('Floating icon', 'easy-whatsapp-contact')?></h3>

				
	        	 <div class="wact-icons-section" data-id="wact-prefefined-icons" id="wact-prefefined-icons">

	        	 	<div class="wact-custom-icon">
	        	 		<span class="wact-icons-section-title"><?php echo __('Custom icon', 'easy-whatsapp-contact')?></span>
	        	 		<div class="wact-upload">
	        	 			<div class="wact-upload-preview-wrapper">
	        	 				 <img class="wact-upload-preview" src="<?php echo $wactCustomIcon ?>"/>
	        	 			</div>
				           
				            <div>
				                <input type="hidden" name="wact-custom-icon" id="wact-custom-icon" value="<?php echo $wactCustomIcon ?>" /> 
				                <button type="submit" class="wact-upload_image_button button"><?php echo __('Upload', 'easy-whatsapp-contact')?></button>
				                <button type="submit" class="wact-remove_image_button button">&times;</button>
				            </div>
				            <div class="wact-custom-icon-radio" >
				            	 <input type="radio" id="wact-icon-style" name="wact-icon-style" value="custom" <?php if( $wactIconStyle == 'custom') echo "checked" ?>>
				            </div>
				        </div>
				      
	        	 	</div>

		        	<div class="wact-default-icons">
		        		<span class="wact-icons-section-title"><?php echo __('Predefined icons', 'easy-whatsapp-contact')?></span	>
    			        <ul class="wact-style-ul-list">
	 						<?php for($i = 1; $i < $wactNumberOfIcons + 1; $i++): ?>	
	 							<li class="wact-style-li">
	 								<div class="wact-style-item">
	 									<img class="wact-icon" height='100px' width='100px' src='<?php echo plugin_dir_url(__FILE__). '../resources/img/icon-style-' . $i . '.svg' ?>'>
	 									<input class="wact-icon-radio" type="radio" id="wact-icon-style" name="wact-icon-style" value="<?php echo 'icon-style-' . $i ?>" <?php if( $wactIconStyle == 'icon-style-' . $i) echo "checked" ?>>
	 								</div>
	 							</li>
	 						<?php endfor; ?>

	 					</ul>
	        	 	</div> 	
	        	 </div>

	        

				<table class="form-table">
					<tbody>

						<tr>
								<th scope="row"><?php echo __('Icon height', 'easy-whatsapp-contact')?></th>
								<td>
									<input type="number" id='wact-icon-size' name='wact-icon-size'  placeholder='' value='<?php echo $wactIconSize ?>'/> px
								</td>
							</tr>

						<tr>
							<th scope="row"><?php echo __('Chat window', 'easy-whatsapp-contact')?></th>
							<td>
								<label><input type="checkbox" id="wact-show-chat-window" name="wact-show-chat-window" value="yes" <?php if( $wactShowChatWindow == 'yes') echo "checked" ?>> <?php echo __('Show', 'easy-whatsapp-contact')?></label><br>
								<p class="description"><?php echo __('Shows a chat to write a message when the icon is pressed', 'easy-whatsapp-contact')?> </p>
							</td>
						</tr>


						<tr>
							<th scope="row"><?php echo __('Chat welcome message', 'easy-whatsapp-contact')?></th>
							<td>
								<textarea style="width: 300px" id='wact-welcome-message' name='wact-welcome-message' type='text' placeholder=''><?php echo wp_unslash($wactWelcomeMessage) ?></textarea>
								<p class="description"><?php echo __('Starting message when the chat is open', 'easy-whatsapp-contact')?> </p>
							</td>
						</tr>

						<tr>
							<th scope="row"><?php echo __('Show in', 'easy-whatsapp-contact')?></th>

							<td>
								<?php echo __('You can use the shortcode <strong>[wact_icon]</strong> wherever you want or activate it globally in the following pages', 'easy-whatsapp-contact')?>
								<br>
								<br>
								<label><input type="checkbox" id="wact-show-options-front-page" name="wact-show-options-front-page" value="yes" <?php if( $wactShowOptionsFrontPage == 'yes') echo "checked" ?>> <?php echo __('Front page', 'easy-whatsapp-contact')?></label><br>
								<label><input type="checkbox" id="wact-show-options-single" name="wact-show-options-single" value="yes" <?php if( $wactShowOptionsSingle == 'yes') echo "checked" ?>> <?php echo __('Single post', 'easy-whatsapp-contact')?></label><br>
								<label><input type="checkbox" id="wact-show-options-page" name="wact-show-options-page" value="yes" <?php if( $wactShowOptionsPage == 'yes') echo "checked" ?>> <?php echo __('Page', 'easy-whatsapp-contact')?></label><br>
								<label><input type="checkbox" id="wact-show-options-archive" name="wact-show-options-archive" value="yes" <?php if( $wactShowOptionsArchive == 'yes') echo "checked" ?>> <?php echo __('Archives', 'easy-whatsapp-contact')?></label><br>
								<label><input type="checkbox" id="wact-show-options-search" name="wact-show-options-search" value="yes" <?php if( $wactShowOptionsSearch == 'yes') echo "checked" ?>> <?php echo __('Search', 'easy-whatsapp-contact')?></label><br>
								<label><input type="checkbox" id="wact-show-options-404" name="wact-show-options-404" value="yes" <?php if( $wactShowOptions404 == 'yes') echo "checked" ?>> <?php echo __('404', 'easy-whatsapp-contact')?></label><br>
								<label><input type="checkbox" id="wact-show-options-product" name="wact-show-options-product" value="yes" <?php if( $wactShowOptionsProduct == 'yes') echo "checked" ?>> <?php echo __('Woocommerce product', 'easy-whatsapp-contact')?></label><br>
								<label><input type="checkbox" id="wact-show-options-cart" name="wact-show-options-cart" value="yes" <?php if( $wactShowOptionsCart == 'yes') echo "checked" ?>> <?php echo __('Woocommerce cart', 'easy-whatsapp-contact')?></label><br>
								<label><input type="checkbox" id="wact-show-options-checkout" name="wact-show-options-checkout" value="yes" <?php if( $wactShowOptionsCheckout == 'yes') echo "checked" ?>> <?php echo __('Woocommerce checkout', 'easy-whatsapp-contact')?></label><br>
								<label><input type="checkbox" id="wact-show-options-account-page" name="wact-show-options-account-page" value="yes"  <?php if( $wactShowOptionsAccountPage == 'yes') echo "checked" ?>> <?php echo __('Woocommerce account', 'easy-whatsapp-contact')?></label><br>
							</td>
						</tr>

						<tr>
							<th scope="row"><?php echo __('Devices', 'easy-whatsapp-contact')?></th>
							<td>
								<select id='wact-show-devices' name='wact-show-devices'>
									<option value='all-devices' <?php if( $wactShowDevices == 'all-devices') echo "selected" ?>><?php echo __('All devices', 'easy-whatsapp-contact')?></option>
									<option value='only-mobile' <?php if( $wactShowDevices == 'only-mobile') echo "selected" ?>><?php echo __('Only mobile devices', 'easy-whatsapp-contact')?></option>
									<option value='only-desktop' <?php if( $wactShowDevices == 'only-desktop') echo "selected" ?>><?php echo __('Only desktop', 'easy-whatsapp-contact')?></option>
								</select>
							</td>
						</tr>
							
				   
							<tr>
								<th scope="row"><?php echo __('Position', 'easy-whatsapp-contact')?></th>
								<td>
									<select id='wact-icon-position' name='wact-icon-position'>
										<option value='bottom-right' <?php if( $wactIconPosition == 'bottom-right') echo "selected" ?>><?php echo __('Bottom right', 'easy-whatsapp-contact')?></option>
										<option value='bottom-left' <?php if( $wactIconPosition == 'bottom-left') echo "selected" ?>><?php echo __('Bottom left', 'easy-whatsapp-contact')?></option>
										<option value='top-right' <?php if( $wactIconPosition == 'top-right') echo "selected" ?>><?php echo __('Top right', 'easy-whatsapp-contact')?></option>
										<option value='top-left' <?php if( $wactIconPosition == 'top-left') echo "selected" ?>><?php echo __('Top left', 'easy-whatsapp-contact')?></option>
									</select>
								</td>
							</tr>
						</div>

						<tr>
							<th scope="row"><?php echo __('Margin sides', 'easy-whatsapp-contact')?></th>
							<td>
								<input type="number" id='wact-icon-margin-sides' name='wact-icon-margin-sides'  placeholder='' value='<?php echo $wactIconMarginSides ?>'/> px
								<p class="description"><?php echo __('Distance between icon and left or right side of the screen', 'easy-whatsapp-contact')?></p>
							</td>
						</tr>

						<tr>
							<th scope="row"><?php echo __('Margin top/bottom', 'easy-whatsapp-contact')?></th>
							<td>
								<input type="number" id='wact-icon-margin-bottom' name='wact-icon-margin-bottom' placeholder='' value='<?php echo $wactIconMarginBottom ?>'/> px
								<p class="description"><?php echo __('Distance between icon and top or bottom of the screen', 'easy-whatsapp-contact')?></p>
							</td>
						</tr>

						<tr>
							<th scope="row"><?php echo __('Z-index', 'easy-whatsapp-contact')?></th>
							<td>
								<input type="number" id='wact-icon-zindex' name='wact-icon-zindex' placeholder='' value='<?php echo $wactIconZindex ?>'/>
								<p class="description"><?php echo __('Modify this value if the icon overlaps other element', 'easy-whatsapp-contact')?></p>
							</td>
						</tr>

						<tr>
							<th scope="row"><?php echo __('Delay', 'easy-whatsapp-contact')?></th>
							<td>
								<input type="number" id='wact-show-delay' name='wact-show-delay'  placeholder='' value='<?php echo $wactShowDelay ?>'/> <?php echo __('Seconds', 'easy-whatsapp-contact')?>
								<p class="description"><?php echo __('Seconds before show icon', 'easy-whatsapp-contact')?></p>
							</td>
						</tr>

						<tr>
							<th scope="row"><?php echo __('Animation', 'easy-whatsapp-contact')?></th>
							<td>
								<select id='wact-icon-animation' name='wact-icon-animation'>
									<?php foreach($wactAnimationStyles as $key => $value): ?>
										<option value='<?php echo $key; ?>' <?php if( $wactIconAnimation == $key) echo "selected" ?>><?php echo $value ?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
				<input type='submit' id='wact-submit' value='<?php echo __('Save settings', 'easy-whatsapp-contact')?>' class="wact-settings-btn">
			</div>

			<div class="wact-section">
				<h3><?php echo __('Shortcode button', 'easy-whatsapp-contact')?></h3>
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row"><?php echo __('Usage', 'easy-whatsapp-contact')?></th>
							<td>
								<?php echo __('Just write the shortcode <strong>[wact_contact]</strong> wherever you want the contact button', 'easy-whatsapp-contact')?>
							</td>
						</tr>

						<tr>
							<th scope="row"><?php echo __('Button height', 'easy-whatsapp-contact')?></th>
							<td>
								<input type="number" id='wact-button-size' name='wact-button-size'  placeholder='' value='<?php echo $wactButtonSize ?>'/> px
							</td>
						</tr>
					</tbody>
				</table>

					 <div class="wact-icons-section" data-id="wact-prefefined-icons" id="wact-prefefined-icons">

	        	 	<div class="wact-custom-icon">
	        	 		<span class="wact-icons-section-title"><?php echo __('Custom button', 'easy-whatsapp-contact')?></span>
	        	 		<div class="wact-upload">
	        	 			<div class="wact-upload-preview-wrapper">
	        	 				 <img class="wact-button-upload-preview" src="<?php echo $wactCustomButton ?>"/>
	        	 			</div>
				           
				            <div>
				                <input type="hidden" name="wact-custom-button" id="wact-custom-button" value="<?php echo $wactCustomButton ?>" /> 
				                <button type="submit" class="wact-button-upload_image_button button"><?php echo __('Upload', 'easy-whatsapp-contact')?></button>
				                <button type="submit" class="wact-button-remove_image_button button">&times;</button>
				            </div>
				            <div class="wact-custom-icon-radio" >
				            	 <input type="radio" id="wact-button-style" name="wact-button-style" value="custom" <?php if( $wactButtonStyle == 'custom') echo "checked" ?>>
				            </div>
				        </div>
				      
	        	 	</div>

		        	<div class="wact-default-icons">
		        		<span class="wact-icons-section-title"><?php echo __('Predefined buttons', 'easy-whatsapp-contact')?></span	>
    			        <ul class="wact-style-ul-list">
	 						<?php for($i = 1; $i < $wactNumberOfIcons + 1; $i++): ?>	
	 							<li class="wact-style-li">
	 								<div class="wact-style-button-item">
	 									<img class="wact-icon" height='50px' width='50px' src='<?php echo plugin_dir_url(__FILE__). '../resources/img/icon-style-' . $i . '.svg' ?>'>
	 									<input class="wact-icon-radio" type="radio" id="wact-button-style" name="wact-button-style" value="<?php echo 'icon-style-' . $i ?>" <?php if( $wactButtonStyle == 'icon-style-' . $i) echo "checked" ?>>
	 								</div>
	 							</li>
	 						<?php endfor; ?>

	 					</ul>
	        	 	</div> 	
	        	 </div>
				<input type='submit' id='wact-submit' value='<?php echo __('Save settings', 'easy-whatsapp-contact')?>' class="wact-settings-btn">
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
(function ($) {
  'use strict';

	$('.wact-upload_image_button').click(function() {
	    var send_attachment_bkp = wp.media.editor.send.attachment;
	    wp.media.editor.send.attachment = function(props, attachment) {
	        $('.wact-upload-preview').attr('src', attachment.url);
	        $('#wact-custom-icon').val(attachment.url);
	        $("input[name=wact-icon-style][value=custom]").attr('checked', 'checked');
	        wp.media.editor.send.attachment = send_attachment_bkp;
	    }
	    wp.media.editor.open();
	    return false;
	});


	$('.wact-remove_image_button').click(function() {
		$("input[name=wact-icon-style][value=custom]").attr('checked', false);
		$("input[name=wact-icon-style][value=icon-style-1]").attr('checked', 'checked');
	     $('.wact-upload-preview').attr('src','');
	     $('#wact-custom-icon').val('');
	    return false;
	});



	$('.wact-button-upload_image_button').click(function() {
	    var send_attachment_bkp = wp.media.editor.send.attachment;
	    wp.media.editor.send.attachment = function(props, attachment) {
	        $('.wact-button-upload-preview').attr('src', attachment.url);
	        $('#wact-custom-button').val(attachment.url);
	        $("input[name=wact-button-style][value=custom]").attr('checked', 'checked');
	        wp.media.editor.send.attachment = send_attachment_bkp;
	    }
	    wp.media.editor.open();
	    return false;
	});


	$('.wact-button-remove_image_button').click(function() {
		$("input[name=wact-button-style][value=custom]").attr('checked', false);
		$("input[name=wact-button-style][value=icon-style-1]").attr('checked', 'checked');
	    $('.wact-button-upload-preview').attr('src','');
	    $('#wact-custom-button').val('');
	    return false;
	});

})(jQuery);

</script>