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
function hoangson_option()
{
    add_theme_support('post-thumbnails');
    // add more title tag 
    add_theme_support('title-tag');
    // add menu for wordpress 
    register_nav_menu('primary', __('Primary Menu', 'manhduc'));
    // add side bar 
    register_sidebar(array(
        'name'          => __('Primary Sidebar', 'manhduc'),
        'id'            => 'primary-sidebar',
        'description'   => __('Widgets in this area will be shown in the primary sidebar.', 'manhduc'),
        'class'=>'primary-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    load_theme_textdomain('manhduc',MANHDUC_THEME_LANG);
}
add_action("init", "hoangson_option");
