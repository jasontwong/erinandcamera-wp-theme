<?php
/**
 * 
 * Template Name: Gallery Page
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

wp_enqueue_script( 'jquery' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/screen.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/gallery.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <?php $images = imageGrouping_get_images(); ?>
    <?php $groups = imageGrouping_get_groups(); ?>
<?php endwhile; // end of the loop. ?>
<script type="text/javascript">
    jQuery(function($){
        var images = [],
            img = {};
    <?php foreach ($images as $group): foreach ($group as $name => $imgs): foreach($imgs as $img): ?>
        img.src = "<?php echo $img['full']; ?>";
        img.width = <?php echo $img['sizes']['full']['width']; ?>;
        img.height = <?php echo $img['sizes']['full']['height']; ?>;
        img.group = '<?php echo $name; ?>';
        images.push(img);
        img = {};
    <?php endforeach; endforeach; endforeach; ?>
        $(window).data('images', images);
    });
</script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/gallery.js"></script>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-24887965-1']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
</script>
</head>

<body <?php body_class(); ?>>
<div id="backgrounds">
<?php
    the_post_thumbnail('full');
?>
</div>
<div id="left-nav"><img src="<?php bloginfo('template_directory'); ?>/images/gallery/arrow-left.png" /></div>
<div id="right-nav"><img src="<?php bloginfo('template_directory'); ?>/images/gallery/arrow-right.png" /></div>
<div id="wrapper" class="hfeed">
	<div id="header">
		<div id="masthead">
            <div class="gallery-nav">
                <?php foreach ($groups as $group): ?>
                    <a href="javascript:;"><?php echo $group; ?></a>
                <?php endforeach; ?>
            </div>
            <a href="/"><img src="<?php bloginfo('template_directory'); ?>/images/gallery/logo.png" /></a>
            <div class="main-nav">
                <div class="left-column column">
                    <a href="/blog/">blog</a>
                </div>
                <div class="right-column column">
                    <a href="/about/">about</a>
                </div>
            </div>
		</div><!-- #masthead -->
	</div><!-- #header -->
</div><!-- #wrapper -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
