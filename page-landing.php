<?php
/**
 * 
 * Template Name: Landing Page
 *
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header('landing'); ?>

		<div id="container">
			<div id="content" class="wide" role="main">
                <div class="bgimg">
                    <img src="<?php bloginfo('template_directory'); ?>/images/landing/bgimg.png" />
                </div>
                <div id="landing-logo">
                    <img src="<?php bloginfo('template_directory'); ?>/images/landing/logo.png" />
                </div>
			</div><!-- #content -->
		</div><!-- #container -->
        <hr class="hidden" />

<?php get_footer('landing'); ?>
