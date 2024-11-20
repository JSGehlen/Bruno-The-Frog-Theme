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
