<?php
/*
$Id: main_page.tpl.php 1775 2012-04-01 19:13:57Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html <?php echo HTML_PARAMS;
  // BOF Separate Pricing Per Customer
    if(!tep_session_is_registered('sppc_customer_group_id')) {
    $customer_group_id = '0';
    } else {
     $customer_group_id = $sppc_customer_group_id;
    }
  // EOF Separate Pricing Per Customer
 
?>>

<head>

<?php require(DIR_WS_INCLUDES . 'meta_tags.php'); 

//Page Name variable - places current php file name into a variable
  $page =  $_SERVER["SCRIPT_NAME"];
  $break = Explode('/', $page);
  $pfile = $break[count($break) - 1];
  //echo $pfile; //debug code - displays current page name. 

// BOF: Remove & Prevent duplicate content with the canonical tag V1.3.2
CanonicalLink( $xhtml = false, 'SSL' ); 
// EOF: Remove & Prevent duplicate content with the canonical tag V1.3.2
?>
<title><?php echo META_TAG_TITLE; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<meta name="keywords" content="<?php echo META_TAG_KEYWORDS; ?>">
<meta name="description" content="<?php echo META_TAG_DESCRIPTION; ?>">
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','css/bootstrap.min.css')); // BTSv1.5 ?>">
<!--<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','stylesheet.css')); // BTSv1.5 ?>">-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<?php if (bts_select('stylesheets', $PHP_SELF)) { // if a specific stylesheet exists for this page it will be loaded ?>
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheets', $PHP_SELF)); // BTSv1.5 ?>">

<?php
} else { ?> 
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','stylesheet.css')); // BTSv1.5 ?>">
<?php  } 

if ( defined('FWR_SUCKERTREE_MENU_ON') && FWR_SUCKERTREE_MENU_ON === 'true' )
echo '<link rel="stylesheet" type="text/css" href="' . (bts_select('stylesheet', 'fwr_suckertree_css_menu.css')) . '">';

// Below is a work around to allow conditional css when javascript is disabled for product tabs.
?>
<link id="noscriptStyle" rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','no_javascript.css')); ?>">
<script type="text/javascript">document.getElementById('noscriptStyle').parentNode.removeChild(document.getElementById('noscriptStyle'));</script>

<?php if (GOOGLE_ANALYTICS_STATUS == 'true') { ?>
<!-- BOF: Google Analytics Code -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo (GOOGLE_UA_CODE); ?>']);
  _gaq.push(['_trackPageview']);
<?php
if (GOOGLE_SUBDOMAIN != 'none') {
echo '_gaq.push([\'_setDomainName\', \'' . GOOGLE_SUBDOMAIN . '\']);';
}
if ($pfile == 'checkout_success.php') {
include(DIR_WS_MODULES . 'analytics.php');
}
?>

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- EOF: Google Analytics Code -->
<?php } ?>
</head>
<body>

<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
        	<div class="row clearfix">
				<div class="col-md-12 column">
                	
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-md-4 column">
                	<?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_TEMPLATES . 'images/' . STORE_LOGO, STORE_NAME) . '</a>'; ?>
				</div>
				<div class="col-md-4 column">
                	<form name="quick_find" action="advanced_search_result.php" method="get">
                	<div class="input-group">
               			<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
  						<input type="text" class="form-control" name="keywords" placeholder="Quick search ...">
                    	<span class="input-group-btn">    
            			<button class="btn btn-primary" type="button">Go</button>
          				</span>
                	</div>
                	<?php echo '<a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH) . '"><b>' . BOX_SEARCH_ADVANCED_SEARCH . '</b></a><br><a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, 'pfrom=' . '0' . '&amp;pto=' . '10000', 'NONSSL') . '">'; ?>View all products</a>
      				<input type="hidden" name="search_in_description" value="0">
      				<input type="hidden" name="inc_subcat" value="1">          			
                	</form>
				</div>
				<div class="col-md-4 column">
                	<div id="cart"><!--
        
    					<div class="basket-logo"><a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>"><img src="<?php echo DIR_WS_TEMPLATES; ?>images/bag2.png" width="90"></a>
                    	</div>
      
        				<div class="heading"><a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>"><h5>Shopping Basket</h5></a>
        					<a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>"><?php echo $cart->count_contents(); ?> items - <?php echo $currencies->format($cart->show_total()); ?></a>
    					</div>
        
        				<a href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING, ''); ?>">
     					<span id="checkout-button">Checkout</span>   
        				</a>

    					<div class="content">
        
        					<?php include(DIR_WS_TEMPLATES . 'includes/modules/scdropdown.php'); ?>
        
        					<a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>">
           					<span id="checkout-button-bottom-left">View Basket</span> 
           					</a>
        		
        					<div class="checkout" style="margin-top:20px;">
            					<a href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING, ''); ?>">
            					<span id="checkout-button-bottom">Checkout</span> 
           						</a>
        					</div>
        
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
    
    <div class="row clearfix">
		<div class="col-md-12 column">
         	<div class="breadcrumb">
				<?php echo $breadcrumb->trail(' &raquo; '); ?>
			</div>
        </div>
	</div>
    
    <div class="row clearfix">
		<div class="col-md-12 column">
			<div class="row clearfix">
				<div class="col-md-2 column"><?php require(bts_select('column', 'column_left.php')); // BTSv1.5 ?>
				</div>
				<div class="col-md-8 column"><?php require(DIR_WS_INCLUDES . 'warnings.php'); ?><?php require (bts_select ('content')); // BTSv1.5 ?>
				</div>
                <div class="col-md-2 column"><?php require(bts_select('column', 'column_right.php')); // BTSv1.5 ?>
				</div>
			</div>
		</div>
	</div>

    <div class="row clearfix">
		<div class="col-md-12 column">
			<?php include (DIR_WS_TEMPLATES . 'includes/modules/boxes.php'); ?>
        </div>
	</div>
        
    <div class="row clearfix">
		<div class="col-md-12 column">
			<?php include (DIR_WS_MODULES . FILENAME_COMMON_PAGE_MODULES); ?>
        </div>
	</div>
    
    
    
    
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    
    <!--// SHOW HIDE BASKET v2-->
<script type="text/javascript">
$("#cart").bind("mouseenter", function() {
    $("#cart").addClass("display");
});

$("#cart").bind("mouseleave", function() {
    $("#cart").removeClass("display");
});
</script>
<!--// SHOW HIDE BASKET v2-->

</body>
</html>