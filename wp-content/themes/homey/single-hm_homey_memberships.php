<?php
/**
 * The Template for displaying all single posts for hm membership
 * @since Homey 1.0
 */
get_header();
global $post, $homey_local;


$homeyPlugin = PLUGINDIR . "/homey-membership";

$uri = explode('/', $_SERVER['REQUEST_URI']);

// Change not required
define('PAYPAL_URL', (homey_option('paypal_api') == 'sandbox')?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");
//define('PAYPAL_ID', 'this@business.example.com');
define('PAYPAL_ID', homey_option('paypal_client_id'));

$baseUrl = sprintf(
    "%s://%s%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME'],
    '/'.$uri[1]
);
$baseUrl .= '/';
$membership_settings = get_option('hm_memberships_options');
$currency = $membership_settings['currency'];
$terms_conditions = homey_option('login_terms_condition');
$enable_password = homey_option('enable_password');
$enable_forms_gdpr = homey_option('enable_forms_gdpr');
$forms_gdpr_text = homey_option('forms_gdpr_text');

$billing_period = get_post_meta( get_the_ID(), 'hm_membership_settings_bill_period', true );
$billing_frequency = get_post_meta( get_the_ID(), 'hm_membership_settings_billing_frequency', true );
$listings_included = get_post_meta( get_the_ID(), 'hm_membership_settings_listings_included', true );
$unlimited_listings = get_post_meta( get_the_ID(), 'hm_membership_settings_unlimited_listings', true );
$featured_listings = get_post_meta( get_the_ID(), 'hm_membership_settings_featured_listings', true );
$stripe_package_id = get_post_meta( get_the_ID(), 'hm_membership_settings_stripe_package_id', true );
$visibility = get_post_meta( get_the_ID(), 'hm_membership_settings_visibility', true );
$images_per_listing = get_post_meta( get_the_ID(), 'hm_membership_settings_images_per_listing', true );
$unlimited_images = get_post_meta( get_the_ID(), 'hm_membership_settings_unlimited_images', true );
$tax_id_stripe = get_post_meta( get_the_ID(), 'hm_membership_settings_tax_id_stripe', true );
$tax_id_paypal = get_post_meta( get_the_ID(), 'hm_membership_settings_tax_id_paypal', true );
$popular_featured = get_post_meta( get_the_ID(), 'hm_membership_settings_popular_featured', true );
$custom_link = get_post_meta( get_the_ID(), 'hm_membership_settings_custom_link', true );
$package_total_price = $package_price = get_post_meta( get_the_ID(), 'hm_membership_settings_package_price', true );

$enable_paypal = homey_option('enable_paypal');
$enable_stripe = homey_option('enable_stripe');
$stripe_processor_link = homey_get_template_link('template/template-payment-complete.php');

?>

<section class="main-content-area">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="page-title">
                        <div class="block-top-title">
                            <?php get_template_part('template-parts/breadcrumb'); ?>
                        </div><!-- block-top-title -->
                    </div><!-- page-title -->
                </div><!-- col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
            </div><!-- .row -->
        </div><!-- .container -->
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="membership-package-order-detail">
                        <div class="block">
                            <div class="block-body">
                                <h3><?php echo esc_html__("Membership Package", 'homey'); ?></h3>

                                <ul class="list-unstyled mebership-list-info">
                                    <li><i class="fa fa-check" aria-hidden="true"></i> <?php echo esc_html__("Package", 'homey'); ?> <strong><?php  the_title(); ?></strong></li>
                                    <li><i class="fa fa-check" aria-hidden="true"></i> <?php echo esc_html__("Price", 'homey'); ?> <strong><?php echo $currency; ?><?php echo $package_price; ?></strong></li>
                                    <li><i class="fa fa-check" aria-hidden="true"></i> <?php echo esc_html__("Time Period", 'homey'); ?> <strong><?php echo $billing_frequency.' '.$billing_period; ?></strong></li>
                                    <li><i class="fa fa-check" aria-hidden="true"></i>  <?php echo __("Number of Listings"); ?><strong><?php echo $listings_included; ?></strong></li>
                                    
<!--                                    <li><i class="fa fa-check" aria-hidden="true"></i> --><?php //echo __("Taxes"); ?><!-- <strong>--><?php //echo $taxes; ?><!--%</strong></li>-->
                                    <li class="total-price"><?php echo __("Total Price"); ?><strong>$<?php echo $package_total_price; ?></strong></li>
                                </ul>

                            </div>
                        </div>
                    </div><!-- membership-package-order-detail -->
                    <div class="text-center">
                        <a href="<?php echo homey_get_template_link('template/template-payment-complete.php'); ?>"><?php echo __("Change Package"); ?></a>
                    </div>
                </div>

                
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="membership-package-wrap">
                        <?php if ( !is_user_logged_in() ): ?>
                            <div class="block">
                                <div class="block-title">
                                    <div class="block-left">
                                        <h2 class="title"><?php echo __("Account Information"); ?></h2>
                                    </div><!-- block-left -->
                                    <div class="block-right">
                                      <?php echo __("Already have an account?"); ?> <a href="#" id="hm_membership_login_btn" data-toggle="modal" data-target="#modal-login"><?php echo esc_attr($homey_local['login_text']); ?></a>
                                    </div><!-- block-right -->
                                </div>
                                <div class="block-body">
                                    <div class="row">
                                        <!--<div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input class="form-control is-valid" placeholder="Enter your first name" type="text">
                                            </div>
                                        </div>--><!-- col-md-6 col-sm-12 -->
                                        <!--<div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input class="form-control is-invalid" placeholder="Enter your last name" type="text">
                                            </div>
                                        </div>--><!-- col-md-6 col-sm-12 -->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo __("Username"); ?></label>
                                                <input name="username" type="text" class="form-control email-input-1" placeholder="<?php esc_html_e('Username','homey'); ?>" />
                                            </div>
                                        </div><!-- col-md-6 col-sm-12 -->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo __("Email"); ?></label>
                                                <input type="useremail" name="useremail" class="form-control email-input-1" placeholder="<?php echo esc_html__('Email', 'homey'); ?>">
                                            </div>
                                        </div><!-- col-md-6 col-sm-12 -->
                                        <?php if( $enable_password == 'yes' ) { ?>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label><?php echo __("Password"); ?></label>
                                                    <input name="register_pass" type="password" class="form-control password-input-1" placeholder="<?php echo esc_html__('Password', 'homey'); ?>">
                                                </div>
                                            </div><!-- col-md-6 col-sm-12 -->
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label><?php echo __("Confirm Password"); ?></label>
                                                    <input name="register_pass_retype"  type="password" class="form-control password-input-2" placeholder="<?php echo esc_html__('Repeat Password', 'homey'); ?>">
                                                </div>
                                            </div><!-- col-md-6 col-sm-12 -->
                                        <?php } ?>

                                        <?php get_template_part('template-parts/google', 'reCaptcha'); ?>

                                        <div class="checkbox pull-left">
                                            <label>
                                                <input name="term_condition" type="checkbox"> <?php echo sprintf( wp_kses(__( 'I agree with your <a href="%s">Terms & Conditions</a>', 'homey' ), homey_allowed_html()), get_permalink($terms_conditions) ); ?>
                                            </label>
                                        </div>
                                        <?php if($enable_forms_gdpr != 0) { ?>
                                            <div class="checkbox pull-left">
                                                <label>
                                                    <input name="privacy_policy" type="checkbox">
                                                    <?php echo wp_kses($forms_gdpr_text, homey_allowed_html()); ?>
                                                </label>
                                            </div>
                                        <?php } ?>

                                        <?php wp_nonce_field( 'homey_register_nonce', 'homey_register_security' ); ?>
                                        <input type="hidden" id="action" name="action" value="homey_register">
                                        <input type="hidden" id="role" name="role" value="homey_host">

                                        <button class="hm_membership_register btn btn-primary">Register</button>
                                        <div class="error-message" id="hm_register_msgs"></div>
                                    </div>
                                </div><!-- block-body -->
                            </div><!-- block -->
                        <?php endif; ?>
                        <div class="block">
                            <div class="block-head table-block">
                                <h2 class="title"><?php echo esc_attr($homey_local['payment_label']); ?></h2>
                            </div>
                            <div class="block-body" >
                                <!--                                <form name="homey_checkout" method="post" class="homey_payment_form" action="--><?php //echo esc_url($stripe_processor_link); ?><!--">-->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3><?php echo esc_attr($homey_local['select_payment']); ?></h3>
                                        <div class="payment-method">
                                            <?php if( $enable_paypal != 0 ) { ?>
                                                <div class="payment-method-block paypal-method">
                                                    <!-- Buy button -->
                                                    <form id="paypal-form" name="paypal-form" action="<?php echo PAYPAL_URL; ?>" method="post">
                                                        <!-- Identify your business so that you can collect the payments -->
                                                        <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
                                                        <!-- Specify a subscriptions button. -->
                                                        <input type="hidden" name="cmd" value="_xclick-subscriptions">
                                                        <!-- Specify details about the subscription that buyers will purchase -->
                                                        <input type="hidden" name="item_name" value="<?php echo 'Gold'; ?>">
                                                        <input type="hidden" name="item_number" value="<?php echo '1231'; ?>">
                                                        <input type="hidden" name="currency_code" value="<?php echo 'USD'; ?>">
                                                        <input type="hidden" name="a3" id="paypalAmt" value="<?php echo $package_price; ?>">
                                                        <input type="hidden" name="p3" id="paypalValid" value="1">
                                                        <input type="hidden" name="t3" value="M">
                                                        <!-- Custom variable user ID, ip, tax id -->
                                                        <input type="hidden" name="custom" value="<?php echo json_encode(array("user_id" => get_current_user_id(), "tax_id" => "$tax_id_paypal", "ip_address" => $_SERVER['REMOTE_ADDR'])) ?>"/>
                                                        <!-- Specify urls -->
                                                        <input type="hidden" name="cancel_return" value="<?php echo $stripe_processor_link; ?>">
                                                        <input type="hidden" name="return" value="<?php echo $stripe_processor_link; ?>">
                                                        <input type="hidden" name="notify_url" value="<?php echo $stripe_processor_link; ?>">
                                                        <!-- Display the payment button -->

                                                        <div class="form-group">
                                                            <label class="control control--radio radio-tab">
                                                                <input class="homey_check_gateway" name="payment_gateway" value="paypal" type="radio">
                                                                <span class="control-text"><?php esc_html_e('Paypal', 'homey'); ?></span>
                                                                <span class="control__indicator"></span>
                                                                <span class="radio-tab-inner"></span>
                                                            </label>
                                                        </div>
                                                    </form>
                                                </div>
                                            <?php } ?>

                                            <?php if( $enable_stripe != 0 ) { ?>
                                                <div class="payment-method-block stripe-method">
                                                    <div class="form-group">
                                                        <label class="control control--radio radio-tab">
                                                            <input class="homey_check_gateway" name="payment_gateway" value="stripe" type="radio">
                                                            <span class="control-text"><?php esc_html_e('Stripe', 'homey'); ?></span>
                                                            <span class="control__indicator"></span>
                                                            <span class="radio-tab-inner"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if( $enable_stripe != 0 ) {
                                    ?>
                                    <!--    <link href="--><?php //echo $baseUrl.$homeyPlugin;?><!--/assets/css/style.css" type="text/css" rel="stylesheet" />-->
                                    <script src="https://js.stripe.com/v3/"></script>
                                    <script src="<?php echo $baseUrl.$homeyPlugin;?>/assets/js/homey_membership_stripe.js"></script>

                                    <div id="error-message"></div>
                                    <input name="basePluginUrl" id="basePluginUrl" value="<?php echo $baseUrl.$homeyPlugin;?>" type="hidden">


                                <?php } ?>
                                <button id="homey_membership_payment" type="button" class="btn btn-primary btn-block"><?php echo esc_attr($homey_local['btn_process_pay']); ?></button>
                                <!--                                </form>-->
                            </div>
                        </div>
                    </div><!-- membership-package-wrap -->
                </div><!-- col-xs-12 col-sm-12 col-md-8 col-lg-8 -->

            </div><!-- .row -->
        </div>   <!-- .container -->
        <script>
            var stripe = Stripe('<?php echo homey_option('stripe_publishable_key'); ?>');
            //Setup event handler to create a Checkout Session when button is clicked
            document.getElementById("homey_membership_payment").addEventListener("click", function(evt) {
                var selectedGateway = document.querySelector('input[name="payment_gateway"]:checked').value;

                if(selectedGateway == 'paypal'){
                    document.getElementById("paypal-form").submit();
                }//paypal

                else if(selectedGateway == 'stripe'){
                    createCheckoutSession('<?php echo $stripe_package_id; ?>', 1, '<?php echo $stripe_processor_link; ?>', '<?php echo $currency; ?>').then(function(data) {
                        // Call Stripe.js method to redirect to the new Checkout page
                        stripe.redirectToCheckout({
                            sessionId: data.id
                        }).then(handleResult);
                    });
                }else{
                    alert('please select payment gateway methods');
                }

            });
        </script>
    </section><!-- main-content-area listing-page grid-listing-page -->

<?php
get_footer();
