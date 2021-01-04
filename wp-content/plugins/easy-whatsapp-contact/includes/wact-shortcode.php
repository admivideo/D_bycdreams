<?php

function wact_shortcode_button () {
	$wactContactPhone = get_option('wact-contact-phone', '');
	$wactPredefinedText = get_option('wact-predefined-text', '');
	$wactCustomButton = get_option('wact-custom-button', "");
	$wactButtonSize = get_option('wact-button-size', "50");
	$wactButtonStyle = get_option('wact-button-style', "icon-style-1");

	if($wactButtonStyle == "custom" && $wactCustomButton == "") {
		$wactButtonStyle = "icon-style-1";
	}

	if($wactButtonStyle == "custom") {
		if($wactCustomButton == "") {
			$wactCustomButton = plugin_dir_url(__FILE__). "../resources/img/icon-style-1.svg'";
		}
	   $wactButton = "<img src='".$wactCustomButton."' height='".$wactButtonSize."px' style='height:".$wactButtonSize."px'>";
	}else{
	   $wactButton = "<img src='".plugin_dir_url(__FILE__). "../resources/img/".$wactButtonStyle.".svg' style='height:".$wactButtonSize."px; width:".$wactButtonSize."px' height='".$wactButtonSize."px' width='".$wactButtonSize."px'>";
	}

	$wactUrl = 'https://api.whatsapp.com/send?phone='. urlencode($wactContactPhone) . '&text=' . $wactPredefinedText;
	
	return "<a class='wact-shortcode-button' href='$wactUrl' target='_blank'> $wactButton </a>";
}