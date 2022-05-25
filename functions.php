<?php 
//REMEMBER TO ENTER API KEYS ON LINE 33 & 132

function pageBanner($args = NULL){
    if(!$args['title']){
        $args['title'] = get_the_title();
    }
    if(!$args['subtitle']){
        $args['subtitle'] = get_field('page_banner_subtitle');
    }
    if(!$args['image']){
        if(get_field('page_banner_image') AND !is_archive() AND !is_home()){
            $args['image'] = get_field('page_banner_image')['sizes']['pageBanner'];
        }
        else{
            $args['image'] = get_theme_file_uri('images/ocean.jpg');
        }
    }
?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['image']; ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
        <div class="page-banner__intro">
                <p><?php echo $args['subtitle']; ?></p>
        </div>
    </div>
</div>

<?php }

function university_files(){
    wp_enqueue_script('google-map', '//maps.googleapis.com/maps/api/js?key=', NULL, '1.0', true); //INSERT API KEY TO END OF URL
    //loads the javascript for google maps API
    wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    //loads the javascript carousel for bus/apples/bread images
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    //above loads font "roboto" from google fonts
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    //above loads social icons
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
    //above loads main css file
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
    //above loads general wp css file

    wp_localize_script('main-university-js', 'universityData', array(
        'root_url' => get_site_url(),
        ''
    ));
    //outputs JS data into the HTML webpage
}

add_action('wp_enqueue_scripts', 'university_files');
//arguments are (when to execute, function to execute)


function university_features(){
    add_theme_support('title-tag');
    //adds title to each page that is unique

    add_theme_support('post-thumbnails');
    //adds pictures to professors as featured images

    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
    //adds custom size versions of images

    // register_nav_menu('headerMenuLocation', 'Header Menu Location');
    // register_nav_menu('footerLocation1', 'Footer Location 1');
    // register_nav_menu('footerLocation2', 'Footer Location 2');
    //for specifying a menu to be customized in WP admin tab, allows for easy targeting in customizing in css for current menu
}
add_action('after_setup_theme','university_features');

//custom post type - EVENTS -- moved to mu-plugins folder

// function university_post_types(){
//     register_post_type('event', array(
//         //(name of new post type, assoc. array)
//         'public' => true,
//         'show_in_rest' => true,
//         'labels' => array(
//             'name' => 'Events',
//             'add_new_item' => 'Add New Event',
//             'edit_item' => 'Edit Event',
//             'all_items' => 'All Events',
//             'singular_name' => 'Event'
//         ), //labels set the sidebar name in admin screen to name given, add new item changes h1 in "add new" screen, etc
//         'menu_icon' => 'dashicons-calendar' //changes sidebar icon, google "wordpress dashicons for reference
//     ));
// }

// add_action('init', 'university_post_types');

// -- end EVENTS --

//modify default query

function university_adjust_queries($query){
    if(!is_admin() AND is_post_type_archive('campus') AND $query -> is_main_query()){
        // $query -> set('orderby', 'title');
        // $query -> set('order', 'ASC');
        $query -> set('posts_per_page', -1);
    }

    if(!is_admin() AND is_post_type_archive('program') AND $query -> is_main_query()){
        $query -> set('orderby', 'title');
        $query -> set('order', 'ASC');
        $query -> set('posts_per_page', -1);
    }
    
    if(!is_admin() AND is_post_type_archive('event') AND $query -> is_main_query()){
        
        $today = date('Ymd');
        
        // $query -> set('posts_per_page', -1);
        $query -> set('meta_key', 'event_date');
        $query -> set('orderby', 'meta_value_num');
        $query -> set('order', 'ASC');
        $query -> set('meta_query', array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
            )
            ));
    }
}

add_action('pre_get_posts', 'university_adjust_queries');


function universityMapKey($api){
    $api['key'] = ''; //INSERT API KEY
    return $api;
}

add_filter('acf/fields/google_map/api', 'universityMapKey');

?>