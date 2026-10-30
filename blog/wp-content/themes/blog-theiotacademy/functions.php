<?php 
	require_once('bs4navwalker.php');
	function arysonblog_scripts(){
		//stylesheet
		wp_enqueue_style('blue_file', get_template_directory_uri().'/asset/css/style.css');
		wp_enqueue_style('bootstrap_file', get_template_directory_uri().'/asset/css/bootstrap.min.css');
		wp_enqueue_style('font_file', get_template_directory_uri().'/asset/css/fontello.css');
		wp_enqueue_style('main_style', get_stylesheet_uri());
		//javascript
		wp_enqueue_script('jquery_file', get_template_directory_uri().'/asset/js/jquery-3.4.1.min.js', array(), '3.4.1', true);
		wp_enqueue_script('bootstrap_file', get_template_directory_uri().'/asset/js/bootstrap.min.js', array(), '4.3.1', true);
		wp_enqueue_script('custom_file', get_template_directory_uri().'/asset/js/cts.js', array(), '1.1', true);
		wp_enqueue_script('custom_file', get_template_directory_uri().'/asset/js/nav-search.js', array(), '1.1', true);
	}
	//add action hook for style and scripts
	add_action('wp_enqueue_scripts', 'arysonblog_scripts', 1);
	
	
	/*logo*/
	function themename_custom_logo_setup() {
	 $defaults = array(
	 'height'      => 100,
	 'width'       => 400,
	 'flex-height' => true,
	 'flex-width'  => true,
	 'header-text' => array( 'site-title', 'site-description' ),
	 );
	 add_theme_support( 'custom-logo', $defaults );
	}
	add_action( 'after_setup_theme', 'themename_custom_logo_setup' );
	
	//thumbnails
	function arysonblog_thumbnail_image(){
		add_theme_support("post-thumbnails");
		//image size
		add_image_size("small-thumbnail",293,195, true);
		add_image_size("banner_image",698,400, true);
		the_post_thumbnail( 'thumbnail', array( 'class' => 'img-fluid' ) );
		//post formats
		add_theme_support("posts_formats",array("aside","gallery","link"));
		set_post_thumbnail_size( 100, 50, true );
	}
	//action hook for thumbnail image
	add_action("after_setup_theme","arysonblog_thumbnail_image");
	
	/*
	* Add custom logo support
	*/
	add_theme_support( 'custom-logo' );
	
	/**
	 * Filter the except length to 20 words.
	 *
	 * @param int $length Excerpt length.
	 * @return int (Maybe) modified excerpt length.
	 */
    function wpdocs_custom_excerpt_length( $length ) {
        return 20;
    }
    add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

	function arysonblog_excerpt_more( $more ) {
	if ( ! is_single() ) {
		$more = sprintf( '<a class="read-more ml-1 main-read-more" href="%1$s">%2$s</a>',
			get_permalink( get_the_ID() ),
			__( 'Read More', 'textdomain' )
		);
	}
	return $more;
	}
	add_filter( 'excerpt_more', 'arysonblog_excerpt_more' );
	//Theme Options
	add_theme_support('menu');
	//navigation
	register_nav_menu('top', 'Top menu');
	//add-navgation-action
	
// 	function my_last_updated_date( $content ) {
// 	$u_time = get_the_time('U');
// 	$u_modified_time = get_the_modified_time('U');
// 	$updated_date = get_the_modified_time('F jS, Y');
// 	$custom_content = $updated_date;
// 	return $custom_content;
// 	}
// 	add_filter( 'the_time', 'my_last_updated_date' );
	//most popular post
	// Schedule an action if it's not already scheduled
	if ( ! wp_next_scheduled( 'subh_daily_cron_action' ) ) {
		wp_schedule_event( time(), 'daily', 'subh_daily_cron_action' );
	}
	/*custom header ads*/
	function wpb_widgets_init() {
 
    register_sidebar( array(
        'name'          => 'Custom Header Widget Area',
        'id'            => 'custom-header-widget',
        'before_widget' => '<div class="chw-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="chw-title">',
        'after_title'   => '</h2>',
    ) );
	}
	add_action( 'widgets_init', 'wpb_widgets_init' );
	
	/*pagination*/
	function pagination_bar() {
    global $wp_query;
 
    $total_pages = $wp_query->max_num_pages;
 
    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));
 
        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => 'page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
        ));
    }
	}
	
    	//** * Enable preview / thumbnail for webp image files.*/
    function webp_upload_mimes( $existing_mimes ) {
        // add webp to the list of mime types
        $existing_mimes['webp'] = 'image/webp';
    
        // return the array back to the function with our added mime type
        return $existing_mimes;
    }
    add_filter( 'mime_types', 'webp_upload_mimes' );

        /* ADD CUSTOM FEATURED IMAGE */
        if (class_exists('MultiPostThumbnails')) {
        new MultiPostThumbnails(
            array(
                // Replace [YOUR THEME TEXT DOMAIN] below with the text domain of your theme (found in the theme's `style.css`).
                'label' => __( 'Secondary Image', '[YOUR THEME TEXT DOMAIN]'),
                'id' => 'secondary-image',
                'post_type' => 'post'
            )
        );
	}
	/*relatedpost*/
	/**
 * Related posts
 * 
 * @global object $post
 * @param array $args
 * @return
 */
remove_filter('pre_user_description', 'wp_filter_kses');

function wcr_related_posts($args = array()) {
    global $post;

    // default args
    $args = wp_parse_args($args, array(
        'post_id' => !empty($post) ? $post->ID : '',
        'taxonomy' => 'category',
        'limit' => 3,
        'post_type' => !empty($post) ? $post->post_type : 'post',
        'orderby' => 'date',
        'order' => 'DESC'
    ));

    // check taxonomy
    if (!taxonomy_exists($args['taxonomy'])) {
        return;
    }

    // post taxonomies
    $taxonomies = wp_get_post_terms($args['post_id'], $args['taxonomy'], array('fields' => 'ids'));

    if (empty($taxonomies)) {
        return;
    }

    // query
    $related_posts = get_posts(array(
        'post__not_in' => (array) $args['post_id'],
        'post_type' => $args['post_type'],
        'tax_query' => array(
            array(
                'taxonomy' => $args['taxonomy'],
                'field' => 'term_id',
                'terms' => $taxonomies
            ),
        ),
        'posts_per_page' => $args['limit'],
        'orderby' => $args['orderby'],
        'order' => $args['order']
    ));

    include( locate_template('inc/related-posts-template.php', false, false) );

    wp_reset_postdata();
}
		
	/**
	 * Reset the post views on daily basis.
	 */
	function subh_reset_postview_counters() {
		$count_key = 'post_views_count';
		$args      = array(
			'numberposts'      => -1,
			'meta_key'         => $count_key,
			'post_type'        => 'post',
			'post_status'      => 'publish',
			'suppress_filters' => true
		);

		$postslist = get_posts( $args );
		foreach ( $postslist as $singlepost ) {
			delete_post_meta( $singlepost->ID, $count_key );
		}
	}
	add_action( 'subh_daily_cron_action', 'subh_reset_postview_counters' ); // Hook into that action that will fire daily.

	/*sidebar*/
	function arysonblog_register_sidebar(){
		register_sidebar(array(
        'name' => __('Primary Sidebar 1', 'theme_name'),
        'id' => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<div class="widget-title"><span>',
        'after_title' => '</span></div>',
    ));
	register_sidebar(array(
        'name' => __('Primary Sidebar 2', 'theme_name'),
        'id' => 'sidebar-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<div class="widget-title">',
        'after_title' => '</div>',
    ));
	}	
	//action hook
	add_action("widgets_init","arysonblog_register_sidebar");
	
	/*adminuser*/
	function cfw_add_user_social_links( $user_contact ) {

    /* Add user contact methods */
    $user_contact['twitter']   = __('Twitter Link', 'textdomain');
    $user_contact['facebook']  = __('Facebook Link', 'textdomain');
    $user_contact['linkedin']  = __('LinkedIn Link', 'textdomain');
    $user_contact['github']    = __('Github Link', 'textdomain');
    $user_contact['instagram'] = __('Instagram Link', 'textdomain');
    $user_contact['dribbble']  = __('Dribbble Link', 'textdomain');
    $user_contact['behance']   = __('Behance Link', 'textdomain');
    $user_contact['skype']     = __('Skype Link', 'textdomain');

    return $user_contact;
	}
	add_filter('user_contactmethods', 'cfw_add_user_social_links');

	function cfw_get_user_social_links() {
    $return  = '<ul class="list-inline">';
    if(!empty(get_the_author_meta('twitter'))) {
        $return .= '<li><a href="'.get_the_author_meta('twitter').'" title="Twitter" target="_blank" id="twitter"><i class="cfw-icon-twitter"></i></a></li>';
    }
    if(!empty(get_the_author_meta('facebook'))) {
        $return .= '<li><a href="'.get_the_author_meta('facebook').'" title="Facebook" target="_blank" id="facebook"><i class="cfw-icon-facebook"></i></a></li>';
    }
    if(!empty(get_the_author_meta('linkedin'))) {
        $return .= '<li><a href="'.get_the_author_meta('linkedin').'" title="LinkedIn" target="_blank" id="linkedin"><i class="cfw-icon-linkedin"></i></a></li>';
    }
    if(!empty(get_the_author_meta('github'))) {
        $return .= '<li><a href="'.get_the_author_meta('github').'" title="Github" target="_blank" id="github"><i class="cfw-icon-github"></i></a></li>';
    }
    if(!empty(get_the_author_meta('instagram'))) {
        $return .= '<li><a href="'.get_the_author_meta('instagram').'" title="Instagram" target="_blank" id="instagram"><i class="cfw-icon-instagram"></i></a></li>';
    }
    if(!empty(get_the_author_meta('dribbble'))) {
        $return .= '<li><a href="'.get_the_author_meta('dribbble').'" title="Dribbble" target="_blank" id="dribbble"><i class="cfw-icon-dribbble"></i></a></li>';
    }
    if(!empty(get_the_author_meta('behance'))) {
        $return .= '<li><a href="'.get_the_author_meta('behance').'" title="Behance" target="_blank" id="behance"><i class="cfw-icon-behance"></i></a></li>';
    }
    if(!empty(get_the_author_meta('skype'))) {
        $return .= '<li><a href="'.get_the_author_meta('skype').'" title="Skype" target="_blank" id="skype"><i class="cfw-icon-skype"></i></a></li>';
    }
    $return .= '</ul>';

    return $return;
	}
	add_filter('user_panel_theme', 'cfw_get_user_social_links');
	
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );
function extra_user_profile_fields( $user ) {  ?>
    <h3><?php _e("Extra profile information", "blank"); ?></h3>

    <table class="form-table">
		<tr>
        <th><label for="etitle"><?php _e("Etitle"); ?></label></th>
        <td>
            <input type="text" name="etitle" id="etitle" value="<?php echo esc_attr( get_the_author_meta( 'etitle', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your Title."); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="edescription"><?php _e("Edescription"); ?></label></th>
        <td>
			<textarea rows="5" cols="30" id="edescription" class="regular-text" name="edescription"><?php echo esc_attr( get_the_author_meta( 'edescription', $user->ID ) ); ?></textarea><br/>
            <span class="description"><?php _e("Please enter your description."); ?></span>
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
    update_user_meta( $user_id, 'etitle', $_POST['etitle'] );
	update_user_meta( $user_id, 'edescription', $_POST['edescription'] );
}
	/**
	* Generate breadcrumbs
	*/

	
	function get_breadcrumb() {
    if (!is_home()) {
        echo '<a href="https://www.theiotacademy.co/">Home</a>';
        echo '<a href="'.home_url().'">Blog</a>';
        if (is_category() || is_single() )
        {
            if( is_category() )
            {
                single_term_title();
            }
            elseif (is_single() )
            {
                $cats = get_the_category( get_the_ID() );
                $cat = array_shift($cats);
                echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $cat->name ) ) . '">'. $cat->name .'</a>';
                the_title();
            }
        } elseif (is_page()) {
            echo the_title();
        }
    }
}
	

/**
 * Social media share buttons
 */
function wcr_share_buttons() {
    $url = urlencode(get_the_permalink());
    $title = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
    $media = urlencode(get_the_post_thumbnail_url(get_the_ID(), 'full'));

    include( locate_template('share-template.php', false, false) );
}
	/*
	*Comment
	*/
	add_shortcode( 'comment_no', 'commno' );
    function commno(){

        $number= get_comments_number(get_the_ID());

        return $number;
	}
	
	
	//setup logo link.
	add_filter( 'get_custom_logo', 'change_logo_url' );
	function change_logo_url() {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$html = sprintf( '<a href="'.home_url().'" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
				esc_url( 'www.google.com' ),
				wp_get_attachment_image( $custom_logo_id, 'full', false, array(
					'class'    => 'custom-logo',
				) )
			);
		return $html;   
	} 
	
	add_filter( 'wp_link_query', 'my_modify_link_query_results' );

// Link to media file URL instead of attachment page
// include 'inherit' post statuses so attachments are returned
add_filter( 'wp_link_query_args', 'my_modify_link_query_args' );
function my_modify_link_query_args( $query ) {
        $query['post_status'] = (array) $query['post_status'];
        $query['post_status'][] = 'inherit';
        
        return $query;
}

// Link to media file URL instead of attachment page
add_filter('post_thumbnail_html','add_external_link_on_page_post_thumbnail',10);
    function add_external_link_on_page_post_thumbnail( $html ) {
    if( is_singular() ) {
            global $post;
            $name = get_post_meta($post->ID, 'ExternalUrl', true);
            if( $name ) {
                    $html = '' . $html . '';
            }
    }
    return $html;
}

//feed
function itsme_disable_feed() {
 wp_die( __( 'No feed available, please visit the <a href="'. esc_url( home_url( '/' ) ) .'">homepage</a>!' ) );
}
//function to call first uploaded image in functions file
function main_image() {
    if(!true){
$files = get_children('post_parent='.get_the_ID().'&post_type=attachment
&post_mime_type=image&order=desc');
  if($files) :
    $keys = array_reverse(array_keys($files));
    $j=0;
    $num = $keys[$j];
    $image=wp_get_attachment_image($num, 'large', true);
    $imagepieces = explode('"', $image);
    $imagepath = $imagepieces[1];
    $main=wp_get_attachment_url($num);
        $template=get_template_directory();
        $the_title=get_the_title();
    //echo "<img src='". home_url() ."/wp-content/uploads/2023/10/no-featured-image.png' alt='Default image' class='frame' />";
  endif;
}
else{
    //echo "<img src='". home_url() ."/wp-content/uploads/2023/10/no-featured-image.png' alt='Default image' class='img-fluid wp-post-image' />";
}
}

add_action('do_feed', 'itsme_disable_feed', 1);
add_action('do_feed_rdf', 'itsme_disable_feed', 1);
add_action('do_feed_rss', 'itsme_disable_feed', 1);
add_action('do_feed_rss2', 'itsme_disable_feed', 1);
add_action('do_feed_atom', 'itsme_disable_feed', 1);
add_action('do_feed_rss2_comments', 'itsme_disable_feed', 1);
add_action('do_feed_atom_comments', 'itsme_disable_feed', 1);
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );

// Calculate Reading Time
function calculate_reading_time($content) {
    $words_per_minute = 400;
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / $words_per_minute);
    return $reading_time;
}