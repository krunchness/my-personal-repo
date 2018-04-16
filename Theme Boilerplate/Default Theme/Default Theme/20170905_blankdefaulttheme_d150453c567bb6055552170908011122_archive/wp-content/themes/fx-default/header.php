<?php 

global $data, $fx_data; ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
	<meta charset="UTF-8">
	<meta name="format-detection" content="telephone=no">
	<?php
	if (is_tablet_ipad()):
		echo '<meta name="viewport" content="width=1100, initial-scale=0"/>';
	else: 
		echo '<meta name="viewport" content="width=device-width, initial-scale=1" />';
	echo '<meta name="format-detection" content="telephone=no">';
	endif; 
	?>

	<link rel="profile" href="http://gmpg.org/xfn/11">   
	<link type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png" rel="icon">
	<title><?php bloginfo('name'); ?><?php wp_title('|'); ?></title>
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class()?> >
	<?php 
	global $fx_data;
	$logo = $fx_data['logo']['url'];

	?>
	<header id="site-header">
		<?php if($fx_data['tb_switch']): ?>
			<section id="top-bar">
				<div class="row">
					<div class="medium-6 small-12 columns">
					<?= apply_filters('the_content', $fx_data['left-topbar']) ?>
					</div>
					<div class="medium-6 small-12 columns">
						<?= apply_filters('the_content', $fx_data['right-topbar']) ?>
					</div>				
				</div>
			</section>
		<?php endif; ?>
		<div class="header-wrapper <?= ($fx_data['enable_sticky_header'] ? 'sticky-header' : '') ?>">
			<div id="desktop-header">
				<div class="row">
					<div class="small-3 columns">
						<div class="site-logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<?php if( $logo): ?> 	
									<img src="<?= $logo; ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
								<?php else: ?>	
									<div class="site-title"><?php bloginfo('name'); ?></div>
								<?php endif; ?>	
							</a>
						</div>						
					</div>
					<nav id="site-menu">
						<div class="large-9 columns menu">
							<div class="menu-wrapper">
								<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
							</div>
						</div>
					</nav>							
				</div>
			</div>
			<div class="mobile" id="mobile-header">
				<div class="row">
					<div class="small-11 columns">
						<div class="site-logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<?php if( $logo) :?> 	
									<img src="<?php echo $logo; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
								<?php else: ?>	
									<h1 class="site-title"><?php bloginfo('name'); ?></h1>
								<?php endif; ?>	
							</a>
						</div>				
					</div>
					<div class="small-1 columns">
						<a href="javascript:void(0)" id="mobile-menu" class="icon">
							<div class="hamburger">
								<div class="menui top-menu"></div>
								<div class="menui mid-menu"></div>
								<div class="menui bottom-menu"></div>
							</div>
						</a>
					</div>
				</div>
				<div class="mobile-cta">
					<div class="row">
						<div class="small-12 columns">
							<?= $data['mobileheader_cta'] ?>
						</div>
					</div>
				</div>	
			</div>
			<div id="lightbox-menu-container" class="mobilenav">
				<div class="mobile-nav-heading">Menu</div>
				<?php wp_nav_menu( array( 'theme_location' => 'mobile-menu' ) ); ?>
			</div>
		</div>	
	</header>