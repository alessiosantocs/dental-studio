<?php
/**
 * Author: Todd Motto | @toddmotto
 * URL: woopstrapblank.com | @woopstrapblank
 * Custom functions, support, custom post types and more.
 */

require_once "modules/is-debug.php";

function posts_index_page_id(){
  return 55;
}

/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
    Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

function mytheme_setup() {
	// Set default values for the upload media box
	update_option('image_default_align', 'center' );
	update_option('image_default_link_type', 'media' );
	update_option('image_default_size', 'large' );

}
add_action('after_setup_theme', 'mytheme_setup');


// This function prevents images to be too big
function replace_default_image_url($content){
  // Extract images into the $matches folder
  if ( ! preg_match_all( '/<img [^>]+>/', $content, $matches ) ) {
    return $content;
  }

  $selected_images = $attachment_ids = array();

  // Cycle through images
  foreach( $matches[0] as $image ) {
    if ( preg_match( '/wp-image-([0-9]+)/i', $image, $class_id ) &&
      ( $attachment_id = absint( $class_id[1] ) ) ) {

      /*
       * If exactly the same image tag is used more than once, overwrite it.
       * All identical tags will be replaced later with 'str_replace()'.
       */
      $selected_images[ $image ] = $attachment_id;
      // Overwrite the ID when the same image is included more than once.
      $attachment_ids[ $attachment_id ] = true;
    }
  }

  foreach ( $selected_images as $image => $attachment_id ) {
    $image_src = preg_match( '/src="([^"]+)"/', $image, $match_src ) ? $match_src[1] : '';
  	list( $image_src ) = explode( '?', $image_src );

    $original_src = wp_get_attachment_image_src($attachment_id, 'full');
    $original_src = $original_src[0];

    if ($image_src === $original_src) {
      $extralarge_src = wp_get_attachment_image_src($attachment_id, 'extralarge');
      $extralarge_src = $extralarge_src[0];

      $new_image = preg_replace( '/ src="([^"]+)"/', ' src="' . $extralarge_src . '"', $image );
  		$content = str_replace( $image, $new_image, $content );
    }


	}

  return $content;
}

add_filter( 'the_content', 'replace_default_image_url' );

if (function_exists('add_theme_support'))
{

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('extralarge', 1500, '', true); // Large Thumbnail
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    // add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
    'default-color' => 'FFF',
    'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
    'default-image'          => get_template_directory_uri() . '/img/headers/default.jpg',
    'header-text'            => false,
    'default-text-color'     => '000',
    'width'                  => 1000,
    'height'                 => 198,
    'random-default'         => false,
    'wp-head-callback'       => $wphead_cb,
    'admin-head-callback'    => $adminhead_cb,
    'admin-preview-callback' => $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('woopstrapblank', get_template_directory() . '/languages');


}

/*------------------------------------*\
    Functions
\*------------------------------------*/

function woopstrapblank_footer_nav($menu_class="", $echo=true)
{
    $menu = wp_nav_menu(
    array(
        'theme_location'  => 'footer-menu',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'menu-{menu slug}-container',
        'container_id'    => '',
        'menu_class'      => $menu_class,
        'menu_id'         => '',
        'echo'            => false,
        'fallback_cb'     => false,
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        // 'items_wrap'      => '%3$s',
        'depth'           => 0,
        'walker'          => ''
        )
    );

    if($menu != false){
      if ($echo) {
        echo $menu;
      }else{
        return $menu;
      }

    }elseif(current_user_can('edit_dashboard')){
      if ($echo) {
        echo 'Add some elements to the "footer-menu" location';
      }else{
        return false;
      }
    }

}

function count_footer_nav_columns(){
  $menu = woopstrapblank_footer_nav("", false);
  return substr_count($menu, 'menu-item-has-children');
}

function woopstrapblank_specialties_nav($menu_class="")
{
    $menu = wp_nav_menu(
    array(
        'theme_location'  => 'specialties-menu',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'menu-{menu slug}-container',
        'container_id'    => '',
        'menu_class'      => $menu_class,
        'menu_id'         => '',
        'echo'            => false,
        'fallback_cb'     => false,
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        // 'items_wrap'      => '%3$s',
        'depth'           => 0,
        'walker'          => ''
        )
    );

    if($menu != false){
      echo $menu;
    }elseif(current_user_can('edit_dashboard')){
      echo 'Add some elements to the "specialties-menu" location';
    }

}

function woopstrapblank_get_featured_content() {
  global $featured_query;

  $args = array(
    'post_type' => 'post',
    'category_name' => 'featured'
  );

  $featured_query = new WP_Query( $args );

  return true;
}

// Load HTML5 Blank scripts (header.php)
function woopstrapblank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        if (HTML5_DEBUG) {
            // jQuery
            wp_deregister_script('jquery');
            wp_register_script('jquery', get_template_directory_uri() . '/bower_components/jquery/dist/jquery.js', array(), '1.11.1');

            // Conditionizr
            wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0');

            // Modernizr
            wp_register_script('modernizr', get_template_directory_uri() . '/bower_components/modernizr/modernizr.js', array(), '2.8.3');

            // Bootstrap
            wp_register_script('bootstrap', get_template_directory_uri() . '/bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js', array());

            // Custom scripts
            wp_register_script(
                'woopstrapblankscripts',
                get_template_directory_uri() . '/js/scripts.js',
                array(
                    'conditionizr',
                    'modernizr',
                    'bootstrap',
                    'jquery'),
                '1.0.0');

            // Enqueue Scripts
            wp_enqueue_script('woopstrapblankscripts');

        // If production
        } else {
            // Scripts minify
            wp_register_script('woopstrapblankscripts-min', get_template_directory_uri() . '/js/scripts.min.js', array(), '1.0.0');
            // Enqueue Scripts
            wp_enqueue_script('woopstrapblankscripts-min');
        }
    }
}

// Load HTML5 Blank conditional scripts
function woopstrapblank_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        // Conditional script(s)
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0');
        wp_enqueue_script('scriptname');
    }
}

// Load HTML5 Blank styles
function woopstrapblank_styles()
{
    if (HTML5_DEBUG) {
        // normalize-css
        wp_register_style('normalize', get_template_directory_uri() . '/bower_components/normalize.css/normalize.css', array(), '3.0.1');

        // Custom CSS
        wp_register_style('woopstrapblank', get_template_directory_uri() . '/style.css', array('normalize'), '1.0');

        // Register CSS
        wp_enqueue_style('woopstrapblank');
    } else {
        // Custom CSS
        wp_register_style('woopstrapblankcssmin', get_template_directory_uri() . '/style.css', array(), '1.0');
        // Register CSS
        wp_enqueue_style('woopstrapblankcssmin');
    }
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'sidebar-menu' => __('Sidebar Menu', 'woopstrapblank'), // Sidebar Navigation
        'footer-menu' => __('Footer Menu', 'woopstrapblank'), // Footer Navigation
        'specialties-menu' => __('Specialties Menu', 'woopstrapblank') // Specialties Navigation
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }elseif (is_category( )) {
    	$cat = get_query_var('cat');
    	$current_category = get_category($cat);

    	if( true ){//(int)$current_category->parent == 0 ) {

    		$args = array(
    			'parent'                   => $current_category->cat_ID,
    			'orderby'                  => 'name',
    			'order'                    => 'ASC',
    			'hide_empty'               => 0,
    			'hierarchical'             => 1,
    			'exclude'                  => '',
    			'include'                  => '',
    			'number'                   => '',
    			'taxonomy'                 => 'category',
    			'pad_counts'               => false
    		);

    		$child_categories = get_categories( $args );

        if( count($child_categories) > 0 ){
          $classes[] = 'category-index';
        }

    	}
    }

    return $classes;
}

// Add custom classes to layout for each page
function add_page_layout_classes_to_body_class($classes)
{
    global $post;

    if (is_page()) {
      $page_layout = get_field_object('page_layout');

      if(!empty($page_layout)){
        $page_layout =$page_layout['value'];
        $classes[] = join($page_layout, ' ');
      }
    }

    return $classes;
}

// Remove the width and height attributes from inserted images
function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}


// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area Sidebar First', 'woopstrapblank'),
        'description' => __('Widget area first row of the sidebar', 'woopstrapblank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s area-1-widget area-widget widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area Sidebar Second', 'woopstrapblank'),
        'description' => __('Widget area second row of the sidebar', 'woopstrapblank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s area-2-widget area-widget widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area Footer
    register_sidebar(array(
        'name' => __('Widget Area Footer', 'woopstrapblank'),
        'description' => __('The widget area that goes in the footer right side', 'woopstrapblank'),
        'id' => 'widget-area-footer',
        'before_widget' => '<div id="%1$s" class="%2$s area-footer-widget area-widget widget">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget-title">',
        'after_title' => '</div>'
    ));

    // Define Sidebar Widget Area Under Footer
    register_sidebar(array(
        'name' => __('Widget Area Under Footer', 'woopstrapblank'),
        'description' => __('The widget that goes below the footer', 'woopstrapblank'),
        'id' => 'widget-area-under-footer',
        'before_widget' => '<div id="%1$s" class="%2$s area-under-footer-widget area-widget widget">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget-title">',
        'after_title' => '</div>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

function home_recent_post_excerpt_length(){
  return 10;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    // $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '...';
    // return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View article', 'woopstrapblank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function woopstrapblankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function woopstrapblankcomments($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
    <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
    <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
    </div>
<?php if ($comment->comment_approved == '0') : ?>
    <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
    <br />
<?php endif; ?>

    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
        <?php
            printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
        ?>
    </div>

    <?php comment_text() ?>

    <div class="reply">
    <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
<?php }

/*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'woopstrapblank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'woopstrapblank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'woopstrapblank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'woopstrapblankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('body_class', 'add_page_layout_classes_to_body_class'); // Add classes from page_layout
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('post_thumbnail_html', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
add_filter('image_send_to_editor', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

require_once "modules/custom-navbar.php";


/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/

require_once "modules/custom-post-specialist.php";
require_once "modules/custom-post-glossary.php";


/*------------------------------------*\
    ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}




require_once "modules/shortcodes.php";

require_once "modules/acf-config.php";
