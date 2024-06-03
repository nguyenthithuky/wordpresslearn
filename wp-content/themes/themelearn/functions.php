<?php
define("MANHDUC_THEME_DIR", get_template_directory());
define("MANHDUC_THEME_URL", get_template_directory_uri());

define("MANHDUC_THEME_CSS", MANHDUC_THEME_URL . "/css");
define("MANHDUC_THEME_IMG", MANHDUC_THEME_URL . "/img");
define("MANHDUC_THEME_JS", MANHDUC_THEME_URL . "/js");
define("MANHDUC_THEME_LANG", MANHDUC_THEME_DIR . "/lang");
define("MANHDUC_THEME_LIP", MANHDUC_THEME_URL . "/lib");
define("MANHDUC_THEME_SCSS", MANHDUC_THEME_URL . "/scss");
define("MANHDUC_THEME_TEMPLATES", MANHDUC_THEME_DIR . "/templates");
function manhduc_enqueue_style()
{
    wp_enqueue_style("manhduc_theme_style_1", "https://fonts.googleapis.com", array(), "1.0", "all");
    wp_enqueue_style("manhduc_theme_style_2", "https://fonts.gstatic.com", array(), "1.0", "all");
    wp_enqueue_style("manhduc_theme_style_3", "https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Roboto:wght@400;500;700&display=swap", array(), "1.0", "all");

    //<!-- Icon Font Stylesheet -->
    wp_enqueue_style("manhduc_theme_style_4", "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css", array(), "1.0", "all");
    wp_enqueue_style("manhduc_theme_style_5", "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css", array(), "1.0", "all");
    //   <!-- Libraries Stylesheet -->
    wp_enqueue_style("manhduc_theme_style_6", MANHDUC_THEME_LIP . "/animate/animate.min.css", array(), "1.0", "all");
    wp_enqueue_style("manhduc_theme_style_7", MANHDUC_THEME_LIP . "/owlcarousel/assets/owl.carousel.min.css", array(), "1.0", "all");
    wp_enqueue_style("manhduc_theme_style_8", MANHDUC_THEME_LIP . "/lightbox/css/lightbox.min.css", array(), "1.0", "all");
    //   <!-- Customized Bootstrap Stylesheet -->
    wp_enqueue_style("manhduc_theme_style_9", MANHDUC_THEME_CSS . "/bootstrap.min.css", array(), "1.0", "all");
    //<!-- Template Stylesheet -->
    wp_enqueue_style("manhduc_theme_style_10", MANHDUC_THEME_CSS . "/style.css", array(), "1.0", "all");
}
add_action("wp_enqueue_scripts", "manhduc_enqueue_style");
function manhduc_enqueue_script()
{
    wp_enqueue_script("manhduc_script_1", "https://code.jquery.com/jquery-3.4.1.min.js", array(), "1.0", true);
    wp_enqueue_script("manhduc_script_2", "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js", array(), "1.0", true);
    wp_enqueue_script("manhduc_script_3", MANHDUC_THEME_LIP . "/wow/wow.min.js", array(), "1.0", true);
    wp_enqueue_script("manhduc_script_4", MANHDUC_THEME_LIP . "/easing/easing.min.js", array(), "1.0", true);
    wp_enqueue_script("manhduc_script_5", MANHDUC_THEME_LIP . "/waypoints/waypoints.min.js", array(), "1.0", true);
    wp_enqueue_script("manhduc_script_6", MANHDUC_THEME_LIP . "/owlcarousel/owl.carousel.min.js", array(), "1.0", true);
    wp_enqueue_script("manhduc_script_7", MANHDUC_THEME_LIP . "/isotope/isotope.pkgd.min.js", array(), "1.0", true);
    wp_enqueue_script("manhduc_script_8", MANHDUC_THEME_LIP . "/lightbox/js/lightbox.min.js", array(), "1.0", true);
    wp_enqueue_script("manhduc_script_9", MANHDUC_THEME_JS . "/main.js", array(), "1.0", true);
}
add_action("wp_enqueue_scripts", "manhduc_enqueue_script");
class HoangSon_Services
{
    function __constructor()
    {
        add_action('init', array(__CLASS__, 'hoangson_service_init'));
        add_filter('single_template', array($this, 'portfolio_single'));
    }
}
function hoangson_theme_option()
{
    add_theme_support('post-thumbnails');
    // add more title tag 
    add_theme_support('title-tag');
    // add menu for wordpress 
    register_nav_menus(
        array(
            'primary' => __('Primary Menu', 'manhduc'),
            'footer'  => __('Footer Menu', 'manhduc')
        )
    );
    // register_nav_menu('primary', __('Primary Menu', 'manhduc'));
    // add side bar 
    register_sidebar(array(
        'name'          => __('Primary Sidebar', 'manhduc'),
        'id'            => 'primary-sidebar',
        'description'   => __('Widgets in this area will be shown in the primary sidebar.', 'manhduc'),
        'class' => 'primary-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    load_theme_textdomain('manhduc', MANHDUC_THEME_LANG);
    // change background color 
    add_theme_support('custom-background', array(
        'default-color' => '#ff6347',
        'default-repeat' => 'no-repeat',
    ));
    add_theme_support('post-formats', array('aside', 'gallery', 'image', 'quote', 'video'));
    // tạo danh sách server mới 
    if (!function_exists("hoangson_option")) {
        function hoangson_option($option = '', $default = null)
        {
            $option = get_option("hoangson_cs_option");
            return isset($option[$option]) ? $option[$option] : $default;
        }
    };

    function hoangson_service_init()
    {
        if (function_exists('hoangson_option')) {
            $slug_text = hoangson_option("Service_slug");
        }
        $slug = !empty($slug_text) ? $slug_text : 'dich-vu';
        register_post_type('services', array(
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $slug),
            'capability_type' => true,
            'has_archive' => true,
            'hierarchical' => true,
            'show_in_rest' => true,
            'menu_position' => true,
            'menu_icon' => true,
            'supports' => true,
            'labels' => array(
                'name' => 'Dịch vụ',
                'singular_name' => __('Dịch vụ', 'manhduc'),
                'menu_name' => __('Dịch vụ', 'manhduc'),
                'name_admin_bar' => __('Dịch vụ', 'manhduc'),
                'add_new' => __('Thêm mới', 'manhduc'),
                'add_new_item' => __('Thêm Dịch vụ', 'manhduc'),
                'new_item' => __('Dịch vụ mới', 'manhduc'),
                'edit_item' => __('Sửa', 'manhduc'),
                'view_item' => __('Xem', 'manhduc'),
                'all_items' => __('tất cả', 'manhduc'),
                'search_items' => __('Tìm kiếm ', 'manhduc'),
                'parent_item_colon' => __('Dịch vụ liên quan', 'manhduc'),
                'not_found' => __('không tìm thấy dịch vụ', 'manhduc'),
                'not_found_in_trast' => __('không tìm thấy dịch vụ bị xóa', 'manhduc'),
            ),


        ));

        // đăng ký service category
        register_taxonomy('service_cat', array('services'), array(
            'hierarchical' => true,
            'show_ui' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => true,
            'labels' => array(
                'name' => __('Danh mục', 'manhduc'),
                'singular_name' => __('Danh mục', 'manhduc'),
                'seach_items' => __('tìm danh mục', 'manhduc'),
                'all_items' => __('Tất cả', 'manhduc'),
                'parent_item' => __('Danh mục liên quan', 'manhduc'),
                'edit_item' => __('sửa', 'manhduc'),
                'update_item' => __('cập nhật', 'manhduc'),
                'add_new_item' => __('Thêm mới', 'manhduc'),
                'new_item_name' => __('Tên mới', 'manhduc'),
                'menu_name' => __('Các Danh mục', 'manhduc'),
            ),
        ));
        // register service tag 
        register_taxonomy('service_tag', array('services'), array(
            'hierarchical' => true,
            'show_ui' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'update_count_callback' => '__update_post_term_count',
            'query_var' => true,
            'rewrite' => array("slug" => 'manhduc_services_tag'),
            'labels' => array(
                'name' => __('Danh mục', 'manhduc'),
                'singular_name' => __('Danh mục', 'manhduc'),
                'seach_items' => __('tìm danh mục', 'manhduc'),
                'all_items' => __('Tất cả', 'manhduc'),
                'parent_item' => __('Danh mục liên quan', 'manhduc'),
                'edit_item' => __('sửa', 'manhduc'),
                'update_item' => __('cập nhật', 'manhduc'),
                'add_new_item' => __('Thêm mới', 'manhduc'),
                'new_item_name' => __('Tên mới', 'manhduc'),
                'menu_name' => __('Các Danh mục', 'manhduc'),
            ),
        ));
    }
};

add_action("init", "hoangson_theme_option");
// dang ki service taxonomy
register_taxonomy('services_cat', 'service', array(
    'hierarchical'      => true,
    'show_ui'           => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'services_cat'),
    'labels'            => array(
        'name'              => _x('Danh muc ', 'taxonomy general name', 'manhduc'),
        'singular_name'     => _x('Genre', 'taxonomy singular name', 'manhduc'),
        'search_items'      => __('Search Genres', 'manhduc'),
        'all_items'         => __('All Genres', 'manhduc'),
        'parent_item'       => __('Parent Genre', 'manhduc'),
        'parent_item_colon' => __('Parent Genre:', 'manhduc'),
        'edit_item'         => __('Edit Genre', 'manhduc'),
        'update_item'       => __('Update Genre', 'manhduc'),
        'add_new_item'      => __('Add New Genre', 'manhduc'),
        'new_item_name'     => __('New Genre Name', 'manhduc'),
        'menu_name'         => __('Genre', 'manhduc'),
    ),

));

// register service tag 
register_taxonomy('services_tag', 'service', array(
    'hierarchical'      => true,
    'show_ui'           => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'services_cat'),
    'labels'            => array(
        'name'              => _x('Danh muc ', 'taxonomy general name', 'manhduc'),
        'singular_name'     => _x('Tag', 'taxonomy singular name', 'manhduc'),
        'search_items'      => __('tim kiem tag ', 'manhduc'),
        'all_items'         => __('All Genres', 'manhduc'),
        'parent_item'       => __('Parent Genre', 'manhduc'),
        'parent_item_colon' => __('Parent Genre:', 'manhduc'),
        'edit_item'         => __('Edit Genre', 'manhduc'),
        'update_item'       => __('Update Genre', 'manhduc'),
        'add_new_item'      => __('Add New Genre', 'manhduc'),
        'new_item_name'     => __('New Genre Name', 'manhduc'),
        'menu_name'         => __('Genre', 'manhduc'),
    ),

));
function manhduc_menu()
{
    // echo '1222222222222222222222';
    $argument = array(
        'container'      => 'div',
        'container_id' => 'navbarCollapse',
        'container_class' => 'collapse navbar-collapse',
        'menu_class'     => 'navbar-nav ms-auto py-0',
        'theme_location' => 'primary',
        'fallback_cb'    => false
    );
    wp_nav_menu($argument);
}

function manhduc_header()
{
?>
    <div class="container-xxl position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="m-0"><i class="fa fa-search me-2"></i>SEO<span class="fs-5">Master</span></h1>
                <!-- <img src="img/logo.png" alt="Logo"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <?php

            manhduc_menu();
            ?>
            <button type="button" class="btn text-secondary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></button>
            <a href="https://buimanhduc.com" class="btn btn-secondary text-light rounded-pill py-2 px-4 ms-3">Bùi Mạnh Đức</a>

        </nav>
    </div>
<?php


}
