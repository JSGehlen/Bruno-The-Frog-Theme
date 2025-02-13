<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */

/**
 * Enqueue the front-end style.css file with a version for cache-busting.
 */
function bruno_the_frog_style()
{
    wp_enqueue_style(
        'bruno-the-frog-style',
        get_stylesheet_uri(),
        [],
        filemtime(get_stylesheet_directory() . '/style.css') // Use file modification time as version
    );
}
add_action('wp_enqueue_scripts', 'bruno_the_frog_style');

/**
 * Enqueue the front-end style.css file for the block editor.
 */
function bruno_the_frog_editor_style()
{
    wp_enqueue_style(
        'bruno-the-frog-editor-style',
        get_stylesheet_directory_uri() . '/style.css',
        [],
        filemtime(get_stylesheet_directory() . '/style.css') // Cache-busting
    );
}
add_action('enqueue_block_editor_assets', 'bruno_the_frog_editor_style');

// Enable theme styles in the block editor
add_theme_support('editor-styles');
add_theme_support('wp-block-styles');


/**
 * Remove bloated inline core color styles.
 *
 * @param \WP_Theme_JSON_Data $theme_json Class to access and update the underlying data.
 *
 * @return \WP_Theme_JSON_Data
 */
add_filter(
    'wp_theme_json_data_default',
    function ($theme_json) {
        $data = $theme_json->get_data();

        // Remove default color palette.
        $data['settings']['color']['palette']['default'] = [];

        // Remove default duotone.
        $data['settings']['color']['duotone']['default'] = [];

        // Remove default gradients.
        $data['settings']['color']['gradients']['default'] = [];

        // Remove default shadows.
        $data['settings']['shadow']['default'] = [];

        // Update the theme data.
        $theme_json->update_with($data);

        return $theme_json;
    }
);

/**
 * Remove core block patterns.
 */
function remove_core_block_patterns()
{
    remove_theme_support('core-block-patterns');
}
add_action('init', 'remove_core_block_patterns', 9);


function add_file_types_to_uploads($file_types)
{
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes);
    return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');

function enqueue_gsap_and_dependencies()
{
    // GSAP Core
    wp_enqueue_script(
        'gsap',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
        array(),
        '3.12.2',
        true
    );

    // GSAP ScrollTrigger
    wp_enqueue_script(
        'gsap-scrolltrigger',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js',
        array('gsap'), // Dependent on GSAP
        '3.12.2',
        true
    );

    // Custom animations script
    wp_enqueue_script(
        'gsap-animations',
        get_template_directory_uri() . '/assets/js/gsap-animations.js',
        array('gsap', 'gsap-scrolltrigger'), // Depends on both GSAP and ScrollTrigger
        filemtime(get_template_directory() . '/assets/js/gsap-animations.js'), // For cache-busting
        true // Load in the footer
    );
}
add_action('wp_enqueue_scripts', 'enqueue_gsap_and_dependencies');

add_filter('the_content', function ($content) {
    // Replace "Prev" button with SVG
    $content = preg_replace(
        '/<button\s+class="glide__arrow\s+glide__arrow--left"[^>]*>.*?<\/button>/',
        '<button class="glide__arrow glide__arrow--left" data-glide-dir="<"><svg width="15" height="27" viewBox="0 0 15 27" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 1L1 13.5L14 26" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></button>',
        $content
    );

    // Replace "Next" button with SVG
    $content = preg_replace(
        '/<button\s+class="glide__arrow\s+glide__arrow--right"[^>]*>.*?<\/button>/',
        '<button class="glide__arrow glide__arrow--right" data-glide-dir=">"><svg width="15" height="27" viewBox="0 0 15 27" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 26L14 13.5L0.999997 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></button>',
        $content
    );

    return $content;
});
