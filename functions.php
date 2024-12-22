<?php
// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * 1. Registrar Custom Post Type (CPT) 'Sorteos'
 */
function register_sorteos_cpt() {
    $labels = array(
        'name'               => 'Sorteos',
        'singular_name'      => 'Sorteo',
        'menu_name'          => 'Sorteos',
        'all_items'          => 'Todos los Sorteos',
        'add_new'            => 'Añadir Nuevo',
        'add_new_item'       => 'Añadir Nuevo Sorteo',
        'edit_item'          => 'Editar Sorteo',
        'new_item'           => 'Nuevo Sorteo',
        'view_item'          => 'Ver Sorteo',
        'search_items'       => 'Buscar Sorteos',
        'not_found'          => 'No se encontraron sorteos.',
        'not_found_in_trash' => 'No se encontraron sorteos en la papelera.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'sorteos'),
        'supports'           => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'menu_icon'          => 'dashicons-tickets-alt', // Icono del menú en el admin
        'show_in_rest'       => true, // Compatible con el editor de bloques
    );

    register_post_type('sorteos', $args);
}
add_action('init', 'register_sorteos_cpt');

/**
 * 2. Registrar Menú Principal
 */
function register_theme_menus() {
    register_nav_menus(array(
        'primary_menu' => __('Menú Principal', 'tu-tema'),
    ));
}
add_action('after_setup_theme', 'register_theme_menus');

/**
 * 3. Encolar Estilos y Scripts
 */
function enqueue_theme_assets() {
    // Estilos
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), null);
    wp_enqueue_style('main-style', get_stylesheet_uri());

    // Scripts
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_theme_assets');

function enqueue_google_fonts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Outfit:wght@700&display=swap', array(), null);
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Outfit&display=swap', array(), null);
}
add_action('wp_enqueue_scripts', 'enqueue_google_fonts');


/**
 * 4. Soporte para Imágenes Destacadas
 */
function theme_supports() {
    add_theme_support('post-thumbnails'); // Activar imágenes destacadas
    add_theme_support('title-tag'); // Activar soporte para el título del documento
    add_theme_support('custom-logo'); // Activar soporte para un logo personalizado
}
add_action('after_setup_theme', 'theme_supports');

function disable_gutenberg_editor() {
    add_filter('use_block_editor_for_post', '__return_false', 10);
}
add_action('init', 'disable_gutenberg_editor');
