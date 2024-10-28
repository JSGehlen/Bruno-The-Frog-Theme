<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */

/**
 * Enqueue the front-end style.css file.
 */
function bruno_the_frog_style()
{
    wp_enqueue_style(
        'bruno-the-frog-style',
        get_stylesheet_uri()
    );
}
add_action('wp_enqueue_scripts', 'bruno_the_frog_style');

/**
 * Enqueue the editor style.css file.
 */
function bruno_the_frog_editor_style()
{
    add_editor_style('style.css'); // This will apply the same styles as the front-end
}
add_action('admin_init', 'bruno_the_frog_editor_style');
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
        error_log('Theme JSON data: ' . print_r($data, true));

        // Update the theme data.
        $theme_json->update_with($data);

        return $theme_json;
    }
);
